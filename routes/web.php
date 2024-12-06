<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\RegisteredUserController;
Use App\Http\Controllers\LoginController;
Use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;

Route::middleware('guest')->group(function () {
    // Register
    
    Route::controller(RegisteredUserController::class)->group(function () {
        Route::get('/register', 'create')->name('register.create');
        Route::post('/register', 'store')->name('register.store');
    });

    // Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('login.create');
        Route::post('/login', 'store')->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    // Veículos
    Route::controller(VeiculoController::class)->group(function () {
        Route::get('/veiculos/create', 'create')->name('veiculos.create');
        Route::post('/veiculos/store', 'store')->name('veiculos.store');
        Route::get('/veiculos/show/{id}', 'show')->name('veiculos.show');
        Route::get('/veiculos/dashboard', 'dashboard')->name('veiculos.dashboard');
        Route::delete('/veiculos/destroy/{id}', 'destroy')->name('veiculos.destroy');
        Route::get('/veiculos/edit/{id}', 'edit')->name('veiculos.edit');
        Route::put('/veiculos/update/{id}', 'update')->name('veiculos.update');
    });

    // Clientes
    Route::controller(ClienteController::class)->group(function () {
        Route::get('/clientes/create', 'create')->name('clientes.create');
        Route::post('/clientes/store', 'store')->name('clientes.store');
        Route::get('/clientes/show/{id}', 'show')->name('clientes.show');
        Route::get('/clientes/dashboard', 'dashboard')->name('clientes.dashboard');
        Route::delete('/clientes/destroy/{id}', 'destroy')->name('clientes.destroy');
        Route::get('/clientes/edit/{id}', 'edit')->name('clientes.edit');
        Route::put('/clientes/update/{id}', 'update')->name('clientes.update');
    });

    // Vendas
    Route::controller(VendaController::class)->group(function () {
        Route::get('/vendas/create', 'create')->name('vendas.create');
        Route::post('/vendas/store', 'store')->name('vendas.store');
        Route::get('/vendas/dashboard', 'vendasdashboard')->name('vendas.dashboard');
        Route::get('/dashboard', 'dashboard')->name('auth.dashboard');
        Route::get('/vendas/show/{id}', 'show')->name('vendas.show');
        Route::delete('/vendas/destroy/{id}', 'destroy')->name('vendas.destroy');
    });
});

// // Register

// Route::controller(RegisteredUserController::class)->group(function () {
//     Route::get('/register', 'create');
//     Route::post('/register', 'store');
   
// });

// // Login

// Route::controller(LoginController::class)->group(function () {
//     Route::get('/dashboard', 'dashboard')->middleware('auth');
//     Route::get('/login', 'create');
//     Route::post('/login', 'store');
//     Route::post('/logout', 'destroy')->middleware('auth');
// });

// // Veiculos

// Route::controller(VeiculoController::class)->group(function () {
//     Route::get('/veiculos/create', 'create');
//     Route::post('/veiculos/store', 'store');
//     Route::get('/veiculos/show/{id}', 'show');
//     Route::get('/veiculos/dashboard', 'dashboard');
//     Route::delete('/veiculos/destroy/{id}', 'destroy');
//     Route::get('/veiculos/edit/{id}', 'edit');
//     Route::put('/veiculos/update/{id}', 'update');
// })->middleware('auth');

// // Pessoas

// Route::controller(ClienteController::class)->group(function (){
//     Route::get('/clientes/create', 'create');
//     Route::post('/clientes/store', 'store');
//     Route::get('/clientes/show/{id}', 'show');
//     Route::get('/clientes/dashboard', 'dashboard');
//     Route::delete('/clientes/destroy/{id}', 'destroy');
//     Route::get('/clientes/edit/{id}', 'edit');
//     Route::put('/clientes/update/{id}', 'update');
// })->middleware('auth');

// //Venda

// Route::controller(VendaController::class)->group(function() {
//     Route::get('/vendas/create', 'create')->name('venda.create');
//     Route::post('/vendas/store', 'store')->name('venda.store');
//     Route::get('/vendas/dashboard', 'vendasdashboard')->name('vendas.dashboard');
//     Route::get('/vendas/show/{id}', 'show')->name('vendas.show');

//     Route::get('/dashboard', [VendaController::class, 'dashboard'])->name('auth.dashboard');

//     Route::delete('/vendas/destroy/{id}', 'destroy');
// })->middleware('auth');