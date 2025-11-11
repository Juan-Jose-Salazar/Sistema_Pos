@extends('layouts.app')

@section('content')
<h1>Editar Categoría de Producto</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('productscategorys.update', $productscategory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nombre de la Categoría:</label>
    <input type="text" name="category_name" value="{{ old('category_name', $productscategory->category_name) }}">
    <button type="submit">Actualizar</button>
</form>

<a href="{{ route('productscategorys.index') }}">Volver a la lista</a>
@endsection
