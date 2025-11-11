<?php

namespace App\Http\Controllers;

use App\Models\ProductsCategorys;
use Illuminate\Http\Request;

class ProductsCategorysController extends Controller
{
    // Mostrar todas las categorías
        public function index()
        {
            $categories = ProductsCategorys::all();
            return view('productscategorys.index', compact('categories'));
        }

        // Mostrar formulario de creación
        public function create()
        {
            return view('productscategorys.create');
        }

        // Guardar nueva categoría
        public function store(Request $request)
        {
            $request->validate([
                'category_name' => 'required|max:100',
            ]);

            ProductsCategorys::create($request->all());
            return redirect()->route('productscategorys.index')->with('success', 'Categoría creada correctamente');
        }

        // Mostrar formulario de edición
        public function edit(ProductsCategorys $productscategory)
        {
            return view('productscategorys.edit', compact('productscategory'));
        }

        // Actualizar categoría existente
        public function update(Request $request, ProductsCategorys $productscategory)
        {
            $request->validate([
                'category_name' => 'required|max:100',
            ]);

            $productscategory->update($request->all());
            return redirect()->route('productscategorys.index')->with('success', 'Categoría actualizada correctamente');
        }

        // Eliminar categoría
        public function destroy(ProductsCategorys $productscategory)
        {
            $productscategory->delete();
            return redirect()->route('productscategorys.index')->with('success', 'Categoría eliminada correctamente');
        }


}
