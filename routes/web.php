<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MikrotikController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [SitesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


    // site routes
    Route::get('/site/{id}', [SitesController::class, 'show'])->name('site');
    Route::get('/sites/create', [SitesController::class, 'create'])->name('sites.create');
    Route::post('sites/store', [SitesController::class, 'store'])->name('sites.store');

    //Clientes
    Route::get('clientes/create/site/{id}', [ClientesController::class, 'create'])->name('clientes.create');
    Route::post('clientes/store', [ClientesController::class, 'store'])->name('clientes.store');
    Route::get('clientes/{id}', [ClientesController::class, 'index'])->name('clientes.index');
    Route::post('clientes/pago', [ClientesController::class, 'pago'])->name('clientes.pago');
    Route::get('clientes/pagos/{id}', [ClientesController::class, 'pagos'])->name('clientes.pagos');
    Route::post('/clientes/import', [ClientesController::class, 'import'])->name('clientes.import');

    Route::get('corte/', [MikrotikController::class, 'clientes_corte'])->name('corte');

    // mikrotik
    Route::post('mikrotik', [MikrotikController::class, 'index'])->name('mikrotik');
    Route::post('mikrotik/store', [MikrotikController::class, 'store'])->name('mikrotik.store');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';
