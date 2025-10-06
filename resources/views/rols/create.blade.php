@extends('layouts.app')

@section('content')
<h1>Crear Rol</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('rols.store') }}" method="POST">
    @csrf
    <label>Nombre del rol:</label>
    <input type="text" name="rol_name" value="{{ old('rol_name') }}">
    <button type="submit">Guardar</button>
</form>

<a href="{{ route('rols.index') }}">Volver a la lista</a>
@endsection
