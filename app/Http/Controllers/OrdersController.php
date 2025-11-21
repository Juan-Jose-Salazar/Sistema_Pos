<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Clients;
use App\Models\Products;
use App\Models\OrdersDetails;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client', 'waiter'])->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
      $clients = Clients::all();
      $waiters = User::where('id_rol', 9)->get();
      $products = Products::all();

      return view('orders.create', compact('clients','waiters','products'));
    }

    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'client' => 'required|exists:clients,id',
            'waiter'=> 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array|min:1'

        ]);




        DB::beginTransaction();
        try{
            $order = Order::create([
                'date' => now(),
                'estado' => 'pending',
                'client' => $request->client,
                'waiter' => $request->waiter
            ]);
            //dd($order);


            foreach($request->products as $index => $productId)
            {
                //dd($productId, $request->quantities[$index]);
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
            //dd($order);


            return redirect()->route('orders.index')->with('succes','pedido creado correctamente');

        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error al crear el pedido:'.$e->getMessage());
        }
    }

    public function edit(Order $order)
    {
        $clients = Clients::all();
        $users = User::where('id_rol', 9)->get();
        $products = Products::all();

        return view('orders.edit', compact('order','users', 'clients','products'));

    }

    public function update(Request $request, Order $order)
    {
         $request->validate([
            'client' => 'required|exists:clients,id',
            'waiter'=> 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'products.*.product' => 'required|exists:products,id',
            'products.*.amount'=> 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        try{
            $order->update([
                'date' => now(),
                'estado' => 'pending',
                'client' => $request->client,
                'waiter' => $request->waiter
            ]);

            OrdersDetails::where('order',$order->id)->delete();

            foreach($request->products as $item)
            {
                OrdersDetails::update([
                    'order' =>$order->id,
                    'product'=>$item['product'],
                    'amount' => $item['amount'],
                    'unit_price' => $item['unit_price']
                ]);
            }


            DB::commit();

            if ($request->estado == 'serverd' && !$order->invoice)
            {
                $total = OrdersDetails::where('order',$order->id)
                                    ->sum(DB::raw('amount * unit_price'));
                Invoices::create([
                    'date' => now(),
                    'total' => $total,
                    'order' => $order->id,
                    'cashier' => 1
                ]);
            }

            return redirect()->route(orders.index)->with('succes','pedido actualizado correctamente');

        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error al crear el pedido:'.$e->getMessage());
        }

    }


}
