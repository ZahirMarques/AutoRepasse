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


// Register
use App\Http\Controllers\RegisteredUserController;
Route::controller(RegisteredUserController::class)->group(function () {
    Route::get('/register', 'create');
    Route::post('/register', 'store');
   
});

// Login
Use App\Http\Controllers\LoginController;
Route::controller(LoginController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware('auth');
    Route::get('/login', 'create');
    Route::post('/login', 'store');
    Route::post('/logout', 'destroy')->middleware('auth');
});

// Veiculos
Use App\Http\Controllers\VeiculoController;
Route::controller(VeiculoController::class)->group(function () {
    Route::get('/veiculos/create', 'create');
    Route::post('/veiculos/store', 'store');
    Route::get('/veiculos/show/{id}', 'show');
    Route::get('/veiculos/dashboard', 'dashboard');
    Route::delete('/veiculos/destroy/{id}', 'destroy');
    Route::get('/veiculos/edit/{id}', 'edit');
    Route::put('/veiculos/update/{id}', 'update');
})->middleware('auth');

// Pessoas
use App\Http\Controllers\ClienteController;
Route::controller(ClienteController::class)->group(function (){
    Route::get('/clientes/create', 'create');
    Route::post('/clientes/store', 'store');
    Route::get('/clientes/show/{id}', 'show');
    Route::get('/clientes/dashboard', 'dashboard');
    Route::delete('/clientes/destroy/{id}', 'destroy');
    Route::get('/clientes/edit/{id}', 'edit');
    Route::put('/clientes/update/{id}', 'update');
})->middleware('auth');

//Venda
use App\Http\Controllers\VendaController;
Route::controller(VendaController::class)->group(function() {
    Route::get('/vendas/create', 'create')->name('venda.create');
    Route::post('/vendas/store', 'store')->name('venda.store');
    Route::get('/vendas/show/{id}', 'show')->name('venda.show');
    Route::get('/dashboard', [VendaController::class, 'dashboard'])->name('auth.dashboard');
// Adicionada a rota com parâmetro para exibir uma venda específica
    // Route::get('/auth/dashboard', 'dashboard')->name('auth.dashboard'); // Adicionada a rota para exibir o dashboard de vendas
})->middleware('auth');