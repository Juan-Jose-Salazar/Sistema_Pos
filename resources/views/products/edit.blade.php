@extends('layouts.app')

@section('content')
    <h1>Editar Producto</h1>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre del producto:</label><br>
        <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"><br><br>

        <label>Categoría:</label><br>
        <select name="category_id">
            <option value="">Sin categoría</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="{{ route('products.index') }}">Volver</a>
@endsection
