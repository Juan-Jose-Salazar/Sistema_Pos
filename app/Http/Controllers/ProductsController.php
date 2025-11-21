<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsCategorys;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductsCategorys::all();
        return view('products.create', compact('categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:products_categorys,id'
        ]);


        Products::create([
            'product_name' => $request->product_name,
            'price' => $request-> price,
            'category' => $request->category
        ]);

        return redirect()->route('products.index')->with('success', 'Producto agregado correctamente');
    }

    public function edit(Products $product)
    {
        $products = Products::all();
        $categories = ProductsCategorys::all();
        return view('productscategorys.edit', compact('product','categories'));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:products_categorys,id'
        ]);

        $product->update($request->all());
        return redirect()->route('productscategorys.index')->with('success', 'Producto actualizado correctamente');//

    }

    public function destroy(Products $product)
    {
            $product->delete();
        return redirect()->route('productscategorys.index')->with('success', 'producto eliminado correctamente');//
    }

}
