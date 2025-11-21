@extends('layouts.app')

@section('content')
<h1>Agregar Producto</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <label>Nombre del producto</label>
    <input type="text" name="product_name" value="{{ old('product_name') }}">

    <label>Precio:</label>
    <input type="text" name="price">


    <label>Categoria:</label>
    <select name="category">
        <option value="">-- Selecciona una categoria --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Guardar</button>
</form>

<a href="{{ route('products.index') }}">Volver a la lista</a>

@endsection
