<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Support\Collection;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoices::with([
            'orderRelation.clientRelation',
            'orderRelation.waiterRelation',
            'cashierRelation',
        ])->latest('date')->get();

        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoices $invoice)
    {
        $invoice->load([
            'cashierRelation',
            'orderRelation.clientRelation',
            'orderRelation.waiterRelation',
            'orderRelation.details.productRelation',
        ]);

        $order = $invoice->orderRelation;
        $details = $order?->details ?? new Collection();
        $subtotal = $order?->calculateTotal() ?? 0;

        return view('invoices.show', [
            'invoice' => $invoice,
            'order' => $order,
            'details' => $details,
            'subtotal' => $subtotal,
        ]);
    }
}