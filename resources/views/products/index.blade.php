@extends('layouts.app')

@section('content')
    <h1>Lista de Productos</h1>

    <a href="{{ route('products.create') }}">+ Crear nuevo producto</a>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if ($products->isEmpty())
        <p>No hay productos registrados.</p>
    @else
        <table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    @if ($product->category)
                        {{ $product->category->category_name }}
                    @else
                        <em>Sin categoría</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}">✏️ Editar</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">🗑️ Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    @endif
@endsection
