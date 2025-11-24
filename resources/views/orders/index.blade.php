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
                    <th>Pago</th>
                    <th>Pedido</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ optional($order->clientRelation)->full_name ?? 'Sin cliente' }}</td>
                        <td>{{ optional($order->waiterRelation)->full_name ?? 'Sin mesero' }}</td>
                        <td>
                            <span class="badge bg-{{ $order->is_paid ? 'success' : 'warning text-dark' }}">
                                {{ $order->is_paid ? 'Pagado' : 'Pendiente' }}
                            </span>
                        </td>
                        <td>
                            @if ($order->details->isEmpty())
                                <span class="text-muted">Sin productos</span>
                            @else
                                <ul class="mb-0">
                                    @foreach ($order->details as $detail)
                                        <li>
                                            {{ optional($detail->product)->product_name ?? 'Producto eliminado' }}
                                            (x{{ $detail->amount }}) -
                                            ${{ number_format($detail->unit_price, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->estado }}</td>
                        <td>{{ $order->date ?? '—' }}</td>
                        <td>
                            @if ($order->estado !== 'served')
                                <form action="{{ route('orders.markServed', $order) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Pedido entregado</button>
                                </form>
                            @endif
                            @if (!$order->is_paid)
                                <form action="{{ route('orders.markPaid', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning text-dark">Pago realizado</button>
                                </form>
                            @endif
                            <a class="btn btn-sm btn-secondary" href="{{ route('orders.edit', $order) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection