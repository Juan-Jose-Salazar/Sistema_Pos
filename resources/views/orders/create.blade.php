@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Pedido</h2>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <label>Cliente</label>
        <select name="client" required>
            <option value="">Seleccione un cliente</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->full_name }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Mesero</label>
        <select name="waiter" required>
            <option value="">Seleccione un mesero</option>
            @foreach($waiters as $user)
                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
            @endforeach
        </select>

        <br><br>

        <h4>Agregar Productos</h4>

        <select id="productSelect">
            <option value="">Seleccione producto</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                    {{ $product->product_name }} - ${{ $product->price }}
                </option>
            @endforeach
        </select>

        <input type="number" id="productAmount" placeholder="Cantidad" min="1" value="1" style="width: 80px;">
        <button type="button" id="addProductBtn">Agregar</button>

        <br><br>

        <table border="1" cellpadding="6" id="productsTable">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>



        <br>
        <button type="submit">Guardar Pedido</button>
    </form>
</div>

<script>
let selectedProducts = [];

document.getElementById('addProductBtn').addEventListener('click', () => {
    const select = document.getElementById('productSelect');
    const amount = document.getElementById('productAmount').value;

    if (!select.value || amount <= 0) return;

    const productId = select.value;
    const productName = select.options[select.selectedIndex].text;
    const unitPrice = select.options[select.selectedIndex].getAttribute('data-price');
    const subtotal = (unitPrice * amount).toFixed(2);


    selectedProducts.push({
        product: productId,
        amount: amount,
        unit_price: unitPrice
    });


    updateTable();
});

function updateTable() {
    const tbody = document.querySelector('#productsTable tbody');
    tbody.innerHTML = '';

    selectedProducts.forEach((p, index) => {
        const row = `
            <tr>
                <td>${document.querySelector('#productSelect option[value="'+p.product+'"]').innerText}
                    <input type="hidden" name="products[]" value="${p.product}">
                </td>
                <td>${p.amount}
                    <input type="hidden" name="quantities[]" value="${p.amount}">
                </td>
                <td>${p.unit_price}</td>
                <td>${(p.amount * p.unit_price).toFixed(2)}</td>
                <td><button type="button" onclick="removeProduct(${index})">X</button></td>
            </tr>
        `;
        tbody.innerHTML += row;
    });


    document.getElementById('productsInput').value = JSON.stringify(selectedProducts);
}

function removeProduct(index) {
    selectedProducts.splice(index, 1);
    updateTable();
}
</script>

@endsection
