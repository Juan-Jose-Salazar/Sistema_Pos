@extends('layouts.app')

@section('content')
    <h1>Bienvenido al Sistema POS</h1>
    <p>Selecciona una sección para continuar:</p>

    <div style="display:flex; gap:20px; flex-wrap:wrap;">
        <a href="{{ route('rols.index') }}" style="padding:10px 15px; background:#3498db; color:white; border-radius:5px;">🧩 Roles</a>
        <a href="{{ route('products.index') }}" style="padding:10px 15px; background:#2ecc71; color:white; border-radius:5px;">🛒 Productos</a>
        <a href="#" style="padding:10px 15px; background:#e67e22; color:white; border-radius:5px;">🧍 Usuarios</a>
    </div>
@endsection
