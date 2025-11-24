@extends('layouts.app')

@section('content')
<div class="hero">
    <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:26px;">
        <h1>Panel principal del Sistema POS</h1>
        <p class="subtitle">Administra las ventas, inventario y usuarios desde un tablero central listo para trabajar.</p>
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <a class="btn-primary" href="{{ route('orders.create') }}"><i class="fa-solid fa-plus"></i> Nueva orden</a>
            <a class="secondary-link" href="{{ route('products.create') }}"><i class="fa-solid fa-circle-plus"></i> Agregar producto</a>
        </div>
    </div>

    <div class="grid grid-cols-3">
        <div class="card">
            <div class="label">Productos</div>
            <div class="value">{{ $stats['products'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-box"></i> Inventario</span>
                <a class="secondary-link" href="{{ route('products.index') }}">Ver lista <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="label">Categorías</div>
            <div class="value">{{ $stats['categories'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-sitemap"></i> Organizadas</span>
                <a class="secondary-link" href="{{ route('productscategorys.index') }}">Gestionar <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="label">Órdenes</div>
            <div class="value">{{ $stats['orders'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-receipt"></i> Ventas</span>
                <a class="secondary-link" href="{{ route('orders.index') }}">Ver órdenes <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="label">Facturas</div>
            <div class="value">{{ $stats['invoices'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-file-invoice-dollar"></i> Cobros</span>
                <a class="secondary-link" href="{{ route('invoices.index') }}">Ver facturas <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="label">Clientes</div>
            <div class="value">{{ $stats['clients'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-users"></i> Activos</span>
                <a class="secondary-link" href="{{ route('clients.index') }}">Gestionar <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="label">Usuarios</div>
            <div class="value">{{ $stats['users'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-user-shield"></i> Staff</span>
                <a class="secondary-link" href="{{ route('users.index') }}">Ver usuarios <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="label">Roles</div>
            <div class="value">{{ $stats['roles'] ?? 0 }}</div>
            <div class="card-actions">
                <span class="pill"><i class="fa-solid fa-id-card"></i> Permisos</span>
                <a class="secondary-link" href="{{ route('rols.index') }}">Configurar <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    
    <div style="margin-top:32px;" class="grid grid-cols-3">
        <div class="card" style="grid-column: span 2;">
            <div class="section-title">Accesos rápidos</div>
            <div class="section-description">Accede a las funciones más comunes sin salir del panel principal.</div>
            <div style="display:grid; gap:10px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
                <a class="btn-primary" href="{{ route('orders.create') }}"><i class="fa-solid fa-plus"></i> Crear orden</a>
                <a class="btn-primary" href="{{ route('products.create') }}"><i class="fa-solid fa-circle-plus"></i> Crear producto</a>
                <a class="btn-primary" href="{{ route('clients.create') }}"><i class="fa-solid fa-user-plus"></i> Nuevo cliente</a>
                <a class="btn-primary" href="{{ route('productscategorys.create') }}"><i class="fa-solid fa-layer-group"></i> Nueva categoría</a>
                <a class="btn-primary" href="{{ route('invoices.index') }}"><i class="fa-solid fa-file-invoice-dollar"></i> Revisar facturas</a>
            </div>
        </div>
        <div class="card">
            <div class="section-title">profe ponganos 5</div>
            <div class="section-description">me dicen que quieren que ponga aqui o si quieren lo quito</div>
        </div>
    </div>
</div>
@endsection