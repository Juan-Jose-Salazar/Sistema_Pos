@extends('layouts.app')

@section('content')

<h1>Lista de products</h1>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('products.create') }}">agregar producto</a>

<table border="1" cellpadding="5">
    <tr>

        <th>Nombre Producto</th>
        <th>Precio</th>
        <th>Categoria</th>
        <th>Acciones</th>
    </tr>

    @foreach($products as $product)
    <tr>

        <td>{{ $product->product_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->products_categorys->category_name }}</td>
        <td>
            <a href="{{ route('products.edit', $product->id) }}">Editar</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este producto?');">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
