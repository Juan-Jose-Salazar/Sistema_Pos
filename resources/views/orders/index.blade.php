@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Pedidos</h1>
        <a class="btn btn-primary" href="{{ route('orders.create') }}">Crear pedido</a>
    </div>

    @if (session('success') || session('succes'))
        <div class="alert alert-success">
            {{ session('success') ?? session('succes') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <p>No hay pedidos registrados.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Mesero</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ optional($order->client)->full_name ?? 'Sin cliente' }}</td>
                        <td>{{ optional($order->waiter)->full_name ?? 'Sin mesero' }}</td>
                        <td>{{ $order->estado }}</td>
                        <td>{{ $order->date ?? '—' }}</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="{{ route('orders.edit', $order) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection