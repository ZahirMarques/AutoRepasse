<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;

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
use App\Http\Controllers\PessoaController;
Route::controller(PessoaController::class)->group(function (){
    Route::get('/pessoa/create', 'create');
    Route::post('/pessoa/store', 'store');
    Route::get('/pessoa/show/{id}', 'show');
    Route::get('/pessoa/dashboard', 'dashboard');
    Route::delete('/pessoa/destroy/{id}', 'destroy');
    Route::get('/pessoa/edit/{id}', 'edit');
    Route::put('/pessoa/update/{id}', 'update');
})->middleware('auth');

//Venda
use App\Http\Controllers\VendaController;
Route::controller(VendaController::class)->group(function(){
    Route::get('/venda/create', 'create');
    Route::post('/venda/store', 'store');
    Route::get('venda/show', 'show');
})->middleware('auth');