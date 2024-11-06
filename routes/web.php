<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);




Route::middleware('auth',RedirectIfAuthenticated::class)->group(function () {
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');





Route::get('/', [ChamadoController::class, 'index'])->name('chamados.index');

Route::get('/chamados/meus', [ChamadoController::class, 'meusChamados'])->name('chamados.meus');

// Rota para apagar um chamado
Route::get('/chamados/{id}/delete', [ChamadoController::class, 'delete'])->name('chamados.delete');
Route::delete('/chamados/{id}', [ChamadoController::class, 'destroy'])->name('chamados.destroy');

// Rota para exibir o formulário de criação de um novo chamado
Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');

// Rota para salvar o chamado
Route::post('/chamados', [ChamadoController::class, 'store'])->name('chamados.store');

Route::get('/chamados/{id}', [ChamadoController::class, 'show'])->name('chamados.show');

Route::get('/usuarios/gerenciar', [UserController::class, 'gerenciarUsuarios'])->name('usuarios.gerenciar');

Route::resource('chamados', ChamadoController::class); 
Route::patch('/chamados/{id}/status', [ChamadoController::class, 'updateStatus'])->name('chamados.updateStatus');



    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    
    // Rota para editar um usuário
    Route::get('/usuarios/{id}/editar', [UserController::class, 'editarUsuario'])->name('usuarios.editar');

    // Rota para atualizar um usuário
    Route::put('/usuarios/{id}', [UserController::class, 'atualizarUsuario'])->name('usuarios.atualizar');

    // Rota para excluir um usuário
    Route::delete('/usuarios/{id}', [UserController::class, 'excluirUsuario'])->name('usuarios.excluir');




});