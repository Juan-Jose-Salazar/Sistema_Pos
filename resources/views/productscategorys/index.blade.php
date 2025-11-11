@extends('layouts.app')

@section('content')
<h1>Categorias de productos</h1>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('productscategorys.create') }}">Crear una nueva categoria</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Nombre de la categoria</th>
        <th>Acciones</th>
    </tr>

    @foreach($categories as $productscategory)
    <tr>

        <td>{{ $productscategory->category_name}}</td>
        <td>
            <a href="{{ route('productscategorys.edit', $productscategory->id) }}">Editar</a>

            <form action="{{ route('productscategorys.destroy', $productscategory->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar esta categoria?');">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
