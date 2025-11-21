@extends('layouts.app')

@section('content')

<h1>Crear Usuario</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('productscategorys.store') }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre del producto</label>
    <input type="text" name="product_name" value="{{ old('product_name') }}">

    <label>Contraseña:</label>
    <input type="password" name="password">

    <label>Precio:</label>
    <input type="text" name="price">


    <label>Categoria:</label>
    <select name="category">
        <option value="">-- Selecciona una categoria --</option>
        @foreach($categories as $productscategory)
            <option value="{{ $productscategory->id }}" {{ old('category') == $productscategory->id ? 'selected' : '' }}>
                {{ $productscategory->category_name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Actualizar</button>
</form>

<a href="{{ route('users.index') }}">Volver a la lista</a>

@endsection
