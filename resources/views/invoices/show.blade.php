@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="mb-1">Factura #{{ $invoice->id }}</h1>
            <p class="subtitle mb-0">Detalle completo del cobro generado a partir del pedido.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fa-solid fa-print"></i> Imprimir
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="mb-2">Datos del local</h5>
                    <p class="mb-1 fw-bold">Restaurante POS</p>
                    <p class="mb-1">Dirección: —</p>
                    <p class="mb-0">Teléfono: —</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="mb-2">Factura</h5>
                    <p class="mb-1">Fecha: {{ $invoice->date ?? $invoice->created_at->format('Y-m-d') }}</p>
                    <p class="mb-1">Pedido: {{ optional($order)->id ?? '—' }}</p>
                    <p class="mb-0">Cajero: {{ optional($invoice->cashierRelation)->full_name ?? '—' }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-uppercase text-muted">Cliente</h6>
                    <p class="mb-1 fw-semibold">{{ optional(optional($order)->clientRelation)->full_name ?? 'Consumidor final' }}</p>
                    <p class="mb-0">Teléfono: {{ optional(optional($order)->clientRelation)->phone ?? '—' }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="text-uppercase text-muted">Atendido por</h6>
                    <p class="mb-1">Mesero: {{ optional(optional($order)->waiterRelation)->full_name ?? '—' }}</p>
                    <p class="mb-0">Fecha del pedido: {{ optional($order)->date ?? '—' }}</p>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center" style="width: 110px;">Cant.</th>
                            <th class="text-end" style="width: 140px;">Precio unit.</th>
                            <th class="text-end" style="width: 160px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($details as $detail)
                            <tr>
                                <td>{{ optional($detail->productRelation)->name ?? 'Producto' }}</td>
                                <td class="text-center">{{ $detail->amount }}</td>
                                <td class="text-end">${{ number_format($detail->unit_price ?? optional($detail->productRelation)->price ?? 0, 2) }}</td>
                                <td class="text-end">${{ number_format(($detail->unit_price ?? optional($detail->productRelation)->price ?? 0) * $detail->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Este pedido no tiene productos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2 fs-5 fw-bold">
                        <span>Total</span>
                        <span>${{ number_format($invoice->total ?? $subtotal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media print {
    body { background: #fff; }
    nav.navbar, .btn, .subtitle { display: none !important; }
    .container { max-width: 960px; }
    .card { box-shadow: none; border: none; }
}
</style>
@endpush