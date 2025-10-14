@extends('layouts.app')

@section('content')
    <h1>Crear Producto</h1>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <label>Nombre del producto:</label><br>
        <input type="text" name="product_name" value="{{ old('product_name') }}"><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}"><br><br>

        <label>Categoría:</label><br>
        <select name="category_id">
            <option value="">Seleccione una categoría</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
            <option value="0">Sin categoría</option>
        </select><br><br>



        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="{{ route('products.index') }}">Volver a la lista</a>
@endsection
