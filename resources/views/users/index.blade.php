@extends('layouts.app')

@section('content')
<h1>Lista de Usuarios</h1>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('users.create') }}">Crear nuevo Usuario</a>

<table border="1" cellpadding="5">
    <tr>

        <th>Nombre</th>
        <th>Estado</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    @foreach($users as $user)
    <tr>

        <td>{{ $user->full_name }}</td>
        <td>{{ $user->estado }}</td>
        <td>{{ $user->rol->rol_name }}</td>
        <td>
            <a href="{{ route('users.edit', $user->id) }}">Editar</a>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<form method="POST" action="{{ route('account.logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Cerrar sesión</button>
</form>
@endsection
