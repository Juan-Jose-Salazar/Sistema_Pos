@extends('layouts.app')

@section('content')
<h1>Productos</h1>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<a href="{{ route('products.create') }}">Agregar Producto</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>

    @forelse($products as $product)
    <tr>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->products_categorys->category_name ?? 'Sin categoría' }}</td>
        <td>
            <a href="{{ route('products.edit', $product->id) }}">Editar</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este producto?');">Eliminar</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4">No hay productos registrados.</td>
    </tr>
    @endforelse
</table>
@endsection