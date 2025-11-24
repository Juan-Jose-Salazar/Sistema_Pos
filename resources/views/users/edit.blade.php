@extends('layouts.app')

@section('content')
<h1>Editar Usuario</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre del usuario:</label>
    <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}">

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}">

    <label>Contraseña:</label>
    <input type="password" name="password" placeholder="Deja vacío si no deseas cambiarla">

    <label>Estado:</label>
    <select name="estado">
        <option value="activo" {{ old('estado', $user->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
        <option value="inactivo" {{ old('estado', $user->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>

    <label>Rol:</label>
    <select name="id_rol">
        @foreach($roles as $rol)
            <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol) == $rol->id ? 'selected' : '' }}>
                {{ $rol->rol_name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Actualizar</button>
</form>

<a href="{{ route('users.index') }}">Volver a la lista</a>
@endsection

