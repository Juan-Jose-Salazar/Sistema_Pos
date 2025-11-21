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

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <label>Nombre del usuario:</label>
    <input type="text" name="full_name" value="{{ old('full_name') }}">

    <label>Contraseña:</label>
    <input type="password" name="password">

    <label>Estado:</label>
    <select name="estado">
        <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
        <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>

    <label>Rol:</label>
    <select name="id_rol">
        <option value="">-- Selecciona un rol --</option>
        @foreach($roles as $rol)
            <option value="{{ $rol->id }}" {{ old('id_rol') == $rol->id ? 'selected' : '' }}>
                {{ $rol->rol_name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Guardar</button>
</form>

<a href="{{ route('users.index') }}">Volver a la lista</a>
@endsection
