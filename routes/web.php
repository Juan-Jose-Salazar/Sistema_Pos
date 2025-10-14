<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolsController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('home'); // 👈 Nueva vista principal
});

Route::resource('rols', RolsController::class);
Route::resource('products', ProductsController::class);
