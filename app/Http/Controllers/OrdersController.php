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
        $orders = Order::with(['client', 'waiter'])
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
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
                $quantity = $request->quantities[$index];
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

        $order->load(['details.product']);

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
                $quantity = $request->quantities[$index];
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

            if (!$order->invoice) {
                $total = OrdersDetails::where('order', $order->id)
                    ->sum(DB::raw('amount * unit_price'));

                Invoices::create([
                    'date' => now(),
                    'total' => $total,
                    'order' => $order->id,
                    'cashier' => auth()->id() ?? 1,
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pedido marcado como entregado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No se pudo marcar el pedido: ' . $e->getMessage());
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
}
