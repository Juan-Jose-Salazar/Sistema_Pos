<?php
use App\Http\Controllers\RolsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('rols.index');
});

Route::resource('rols', RolsController::class);
