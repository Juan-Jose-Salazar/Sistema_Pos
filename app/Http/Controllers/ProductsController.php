<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductsCategorys;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $products = Product::all(); // trae todos los productos de la base
    return view('products.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $categories = \App\Models\ProductsCategorys::all();
    return view('products.create', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|integer'
        ]);
        Product::create([
        'product_name' => $request->input('product_name'),
        'price' => $request->input('price'),
        'category_id' => $request->input('category_id') ?: null, // Si elige “Sin categoría”
]);

        return redirect()->route('products.index')
                         ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = ProductsCategorys::all();
    return view('products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required|string|max:100',
        'price' => 'required|numeric|min:0',
        'category_id' => 'nullable|integer',
    ]);

    $product = Product::findOrFail($id);
    $product->update([
        'product_name' => $request->input('product_name'),
        'price' => $request->input('price'),
        'category_id' => $request->input('category_id') ?: null,
    ]);

    return redirect()->route('products.index')
                     ->with('success', 'Producto actualizado correctamente.');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')
                     ->with('success', 'Producto eliminado exitosamente.');
}

}
