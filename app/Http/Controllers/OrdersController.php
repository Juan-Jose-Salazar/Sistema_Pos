<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Invoices;
use App\Models\Order;
use App\Models\OrdersDetails;
use App\Models\Products;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['clientRelation', 'waiterRelation', 'details.productRelation', 'invoice'])
            ->latest()
            ->get();
        $cashiers = $this->getCashiers();

        return view('orders.index', compact('orders', 'cashiers'));
    }

    public function create()
    {
        $clients = Clients::all();
        $waiters = $this->getWaiters();
        $products = Products::all();

        return view('orders.create', compact('clients', 'waiters', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|exists:clients,id',
            'waiter' => 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array|min:1'
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'date' => now(),
                'estado' => 'pending',
                'client' => $request->client,
                'waiter' => $request->waiter
            ]);

            foreach ($request->products as $index => $productId) {
                $quantity = max(1,(int) $request->quantities[$index]);
                $product = Products::findOrFail($productId);

                OrdersDetails::create([
                    'order' => $order->id,
                    'product' => $productId,
                    'amount' => $quantity,
                    'unit_price' => $product->price  // ESTE CAMPO ES CLAVE
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pedido creado correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error al crear el pedido:' . $e->getMessage());
        }
    }

    public function edit(Order $order)
    {
        $clients = Clients::all();
        $users = $this->getWaiters();
        $products = Products::all();

        $order->load(['details.productRelation']);

        return view('orders.edit', compact('order', 'users', 'clients', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client' => 'required|exists:clients,id',
            'waiter' => 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array|min:1'
        ]);

        DB::beginTransaction();
        try {
            $order->update([
                'date' => now(),
                'estado' => 'pending',
                'client' => $request->client,
                'waiter' => $request->waiter
            ]);

            OrdersDetails::where('order',$order->id)->delete();

            foreach ($request->products as $index => $productId) {
                $quantity = max(1,(int) $request->quantities[$index]);
                $product = Products::findOrFail($productId);

                OrdersDetails::create([
                    'order' => $order->id,
                    'product' => $productId,
                    'amount' => $quantity,
                    'unit_price' => $product->price,
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pedido actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error al crear el pedido:' . $e->getMessage());
        }
    }

    public function markServed(Order $order)
    {
        DB::beginTransaction();

        try {
            if ($order->estado !== 'served') {
                $order->update([
                    'estado' => 'served',
                ]);
            }

            $order->loadMissing('details.productRelation');

                $total = $order->calculateTotal();

            $order->invoice()->updateOrCreate(
                ['order' => $order->id],
                [
                    'date' => now(),
                    'total' => $total,
                     'cashier' => optional($order->invoice)->cashier ?? auth()->id(),
                ]
            );

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pedido marcado como entregado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No se pudo marcar el pedido: ' . $e->getMessage());
        }
    }

        public function markPaid(Request $request, Order $order)
    {
         $request->validate([
            'cashier' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            $order->loadMissing('details.productRelation');

            if ($order->details->isEmpty()) {
                return redirect()->back()->with('error', 'No se puede registrar el pago sin productos.');
            }

            $total = $order->calculateTotal();

            $order->invoice()->updateOrCreate(
                ['order' => $order->id],
                [
                    'date' => now(),
                    'total' => $total,
                    'cashier' => $request->input('cashier'),
                ]
            );

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pago registrado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No se pudo registrar el pago: ' . $e->getMessage());
        }
    }

    private function getWaiters()
    {
        $meseroRoleIds = Rol::whereRaw('LOWER(rol_name) = ?', ['mesero'])->pluck('id');

        return User::where(function ($query) use ($meseroRoleIds) {
            $query->whereIn('id_rol', $meseroRoleIds)
                ->orWhere('id_rol', 9)
                ->orWhereHas('rol', function ($subquery) {
                    $subquery->whereRaw('LOWER(rol_name) = ?', ['mesero']);
                });
        })
        ->orderBy('full_name')
        ->get();
    }

    private function getCashiers()
    {
        $cashierRoleIds = Rol::whereRaw('LOWER(rol_name) = ?', ['cajero'])->pluck('id');

        return User::where(function ($query) use ($cashierRoleIds) {
            $query->whereIn('id_rol', $cashierRoleIds)
                ->orWhere('id_rol', 9)
                ->orWhereHas('rol', function ($subquery) {
                    $subquery->whereRaw('LOWER(rol_name) = ?', ['cajero']);
                });
        })
        ->orderBy('full_name')
        ->get();
    }
}