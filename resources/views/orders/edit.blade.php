@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Editar pedido #{{ $order->id }}</h2>
            <p class="text-muted mb-0">Actualiza el cliente, mesero o los productos del pedido.</p>
        </div>
        <a class="btn btn-outline-secondary" href="{{ route('orders.index') }}">← Volver a la lista</a>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Cliente</label>
                <select name="client" class="form-select" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" @selected($client->id === $order->client)>
                            {{ $client->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Mesero</label>
                <select name="waiter" class="form-select" required>
                    <option value="">Seleccione un mesero</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id === $order->waiter)>
                            {{ $user->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4">
            <div class="d-flex align-items-end gap-2">
                <div class="flex-grow-1">
                    <label class="form-label fw-semibold">Agregar producto</label>
                    <select id="productSelect" class="form-select">
                        <option value="">Seleccione producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->product_name }} - ${{ $product->price }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="width: 150px;">
                    <label class="form-label fw-semibold">Cantidad</label>
                    <input type="number" id="productAmount" class="form-control" placeholder="Cantidad" min="1" value="1">
                </div>
                <button type="button" class="btn btn-primary" id="addProductBtn">Agregar</button>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered align-middle" id="productsTable">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th style="width: 140px;">Cantidad</th>
                        <th style="width: 140px;">Precio unidad</th>
                        <th style="width: 140px;">Subtotal</th>
                        <th style="width: 70px;"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-success">Actualizar pedido</button>
        </div>
    </form>
</div>

<script>
    let selectedProducts = @json(
        $order->details->map(fn ($detail) => [
            'product' => $detail->product,
            'amount' => $detail->amount,
            'unit_price' => $detail->unit_price,
        ])
    );

    const productSelect = document.getElementById('productSelect');
    const productAmount = document.getElementById('productAmount');
    const addProductBtn = document.getElementById('addProductBtn');
    const tableBody = document.querySelector('#productsTable tbody');

    function updateTable() {
        tableBody.innerHTML = '';

        selectedProducts.forEach((p, index) => {
            const option = productSelect.querySelector(`option[value="${p.product}"]`);
            const label = option ? option.text : 'Producto eliminado';
            const subtotal = (p.amount * p.unit_price).toFixed(2);

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    ${label}
                    <input type="hidden" name="products[]" value="${p.product}">
                </td>
                <td>
                    ${p.amount}
                    <input type="hidden" name="quantities[]" value="${p.amount}">
                </td>
                <td>$${Number(p.unit_price).toFixed(2)}</td>
                <td>$${subtotal}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeProduct(${index})">X</button>
                </td>
            `;

            tableBody.appendChild(row);
        });
    }

    function removeProduct(index) {
        selectedProducts.splice(index, 1);
        updateTable();
    }

    function addProduct() {
        const productId = productSelect.value;
        const amount = Number(productAmount.value || 0);

        if (!productId || amount <= 0) return;

        const existingIndex = selectedProducts.findIndex((p) => p.product === productId);
        const unitPrice = Number(productSelect.options[productSelect.selectedIndex].getAttribute('data-price'));

        if (existingIndex >= 0) {
            selectedProducts[existingIndex].amount = Number(selectedProducts[existingIndex].amount) + amount;
        } else {
            selectedProducts.push({
                product: productId,
                amount: amount,
                unit_price: unitPrice
            });
        }

        productSelect.value = '';
        productAmount.value = 1;
        updateTable();
    }

    addProductBtn.addEventListener('click', addProduct);
    updateTable();
</script>
@endsection
