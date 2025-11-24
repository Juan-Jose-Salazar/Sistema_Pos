<?php

namespace App\Http\Controllers;

use App\Models\Invoices;

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
}