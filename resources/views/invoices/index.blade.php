@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="mb-1">Facturas</h1>
            <p class="subtitle mb-0">Resumen de las facturas generadas a partir de los pedidos.</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left"></i> Volver al panel</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($invoices->isEmpty())
        <p class="text-muted">Aún no hay facturas registradas.</p>
    @else
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Mesero</th>
                    <th>Cajero</th>
                    <th>Total</th>
                    <th>Fecha</th>
                     <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ optional($invoice->orderRelation)->id ?? '—' }}</td>
                        <td>{{ optional(optional($invoice->orderRelation)->clientRelation)->full_name ?? '—' }}</td>
                        <td>{{ optional(optional($invoice->orderRelation)->waiterRelation)->full_name ?? '—' }}</td>
                        <td>{{ optional($invoice->cashierRelation)->full_name ?? '—' }}</td>
                        <td>${{ number_format($invoice->total, 2) }}</td>
                        <td>{{ $invoice->date ?? '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-file-invoice"></i> Ver detalle
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection