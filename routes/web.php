<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/estoque', function () {
//     return view('estoque');
// })->middleware(['auth', 'verified'])->name('estoque');

Route::get('/estoque', [ProdutoController::class, 'estoque'], function () {
    return view('estoque');
})->middleware(['auth', 'verified'])->name('estoque');


// Rota para a página de cadastro
Route::get('/cadastro', function () {
    return view('cadastro');
})->middleware(['auth', 'verified'])->name('cadastro');

// Rota para salvar o produto
Route::post('/cadastro', [ProdutoController::class, 'store'])->name('produto.store');

Route::get('/vendas', function () {
    return view('vendas');
})->middleware(['auth', 'verified'])->name('vendas');

// Rota para a página de clientes
Route::get('/clientes', [ClienteController::class, 'listaCliente'], function () {
    return view('clientes');
})->middleware(['auth', 'verified'])->name('clientes');

// Rota para salvar o cliente
Route::post('/clientes', [ClienteController::class, 'clients'])->name('cliente.clients');

Route::get('/contasReceber', function () {
    return view('contasReceber');
})->middleware(['auth', 'verified'])->name('contasReceber');

Route::get('/relatorios', function () {
    return view('relatorios');
})->middleware(['auth', 'verified'])->name('relatorios');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
