@extends('layouts.app')

@section('content')
<h1>Clientes</h1>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('clients.create') }}">Agregar Cliente</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Email</th>
    </tr>

    @foreach($clients as $client)
    <tr>
        <td>{{ $client->full_name }}</td>
        <td>{{ $client->phone_number }}</td>
        <td>{{ $client->email }}</td>
        <td>
            <a href="{{ route('clients.edit', $client->id) }}">Editar</a>

            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este ususario?');">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
