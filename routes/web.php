<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



Route::middleware('auth',RedirectIfAuthenticated::class)->group(function () {

Route::get('/', [ChamadoController::class, 'index'])->name('chamados.index');

// Rota para apagar um chamado
Route::get('/chamados/{id}/delete', [ChamadoController::class, 'delete'])->name('chamados.delete');
Route::delete('/chamados/{id}', [ChamadoController::class, 'destroy'])->name('chamados.destroy');

// Rota para exibir o formulário de criação de um novo chamado
Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');

// Rota para salvar o chamado
Route::post('/chamados', [ChamadoController::class, 'store'])->name('chamados.store');

Route::get('/chamados/{id}', [ChamadoController::class, 'show'])->name('chamados.show');


Route::resource('chamados', ChamadoController::class); 
Route::patch('/chamados/{id}/status', [ChamadoController::class, 'updateStatus'])->name('chamados.updateStatus');
});