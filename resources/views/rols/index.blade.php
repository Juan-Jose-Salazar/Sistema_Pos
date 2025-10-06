@extends('layouts.app')

@section('content')
<h1>Lista de Roles</h1>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('rols.create') }}">Crear nuevo rol</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    @foreach($rols as $rol)
    <tr>
        <td>{{ $rol->id }}</td>
        <td>{{ $rol->rol_name }}</td>
        <td>
            <a href="{{ route('rols.edit', $rol->id) }}">Editar</a>

            <form action="{{ route('rols.destroy', $rol->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este rol?');">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
