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

<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <label>Nombre del cliente:</label>
    <input type="text" name="full_name" value="{{ old('full_name') }}">
    <label>Telefono:</label>
    <input type="text" name="phone_number" value="{{ old('phone_number') }}">
    <label>Email:</label>
    <input type="text" name="email" value="{{ old('email')}}">
    <button type="submit">Guardar</button>
</form>

<a href="{{ route('clients.index') }}">Volver a la lista</a>
@endsection
