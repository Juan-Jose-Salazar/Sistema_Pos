<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsCategorysController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Models\Clients;
use App\Models\Order;
use App\Models\Products;
use App\Models\ProductsCategorys;
use App\Models\Rol;
use App\Models\User;


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $stats = [
            'users' => User::count(),
            'clients' => Clients::count(),
            'categories' => ProductsCategorys::count(),
            'products' => Products::count(),
            'orders' => Order::count(),
            'roles' => Rol::count(),
        ];

        return view('home', compact('stats')); // 👈 Nueva vista principal
    });

    Route::get('/rols', [RolsController::class, 'index'])->name('rols.index');
    Route::get('/rols/create', [RolsController::class, 'create'])->name('rols.create');
    Route::post('/rols/store', [RolsController::class, 'store'])->name('rols.store');
    Route::get('/rols/edit{rol}', [RolsController::class, 'edit'])->name('rols.edit');
    Route::put('/rols/update/{rol}', [RolsController::class, 'update'])->name('rols.update');
    Route::delete('/rols/destroy/{rol}', [RolsController::class, 'destroy'])->name('rols.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/edit{user}', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientsController::class, 'create'])->name('clients.create');
    Route::post('/clients/store', [ClientsController::class, 'store'])->name('clients.store');
    Route::get('/clients/edit{client}', [ClientsController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/update/{client}', [ClientsController::class, 'update'])->name('clients.update');
    Route::delete('/clients/destroy/{client}', [ClientsController::class, 'destroy'])->name('clients.destroy');

    Route::get('/productscategorys', [ProductsCategorysController::class, 'index'])->name('productscategorys.index');
    Route::get('/productscategorys/create', [ProductsCategorysController::class, 'create'])->name('productscategorys.create');
    Route::post('/productscategorys/store', [ProductsCategorysController::class, 'store'])->name('productscategorys.store');
    Route::get('/productscategorys/edit/{productscategory}', [ProductsCategorysController::class, 'edit'])->name('productscategorys.edit');
    Route::put('/productscategorys/update/{productscategory}', [ProductsCategorysController::class, 'update'])->name('productscategorys.update');
    Route::delete('/productscategorys/destroy/{productscategory}', [ProductsCategorysController::class, 'destroy'])->name('productscategorys.destroy');

    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{product}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/destroy/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrdersController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('/orders/edit/{order}', [OrdersController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/update/{order}', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('/orders/destroy/{order}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
