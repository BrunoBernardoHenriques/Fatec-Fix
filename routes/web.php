<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function() {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    
    Route::get('register', function() {
        if (Auth::check() && Auth::user()->type == 1) {
            return app(AuthController::class)->showRegisterForm(); 

        }
        return redirect('/');
    })->name('auth.register');
    
    Route::post('register', [AuthController::class, 'register']);

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/', [ChamadoController::class, 'index'])->name('chamados.index');

    Route::get('/chamados/{id}/delete', [ChamadoController::class, 'delete'])->name('chamados.delete');
    Route::delete('/chamados/{id}', [ChamadoController::class, 'destroy'])->name('chamados.destroy');
    Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');
    Route::post('/chamados', [ChamadoController::class, 'store'])->name('chamados.store');
    Route::get('/chamados/{id}', [ChamadoController::class, 'show'])->name('chamados.show');

    Route::get('/usuarios/gerenciar', [UserController::class, 'gerenciarUsuarios'])->name('usuarios.gerenciar');
    Route::resource('chamados', ChamadoController::class); 
    Route::patch('/chamados/{id}/status', [ChamadoController::class, 'updateStatus'])->name('chamados.updateStatus');

    
    Route::get('/usuarios', function() {
        if (Auth::check() && Auth::user()->type == 1) {
            return app(UserController::class)->index();
        }
        return redirect('/');
    })->name('usuarios.index');
    
    Route::get('/usuarios/{id}/editar', [UserController::class, 'editarUsuario'])->name('usuarios.editar');
    Route::put('/usuarios/{id}', [UserController::class, 'atualizarUsuario'])->name('usuarios.atualizar');
  Route::get('/dashboard', function() {
    if (Auth::check() && Auth::user()->type == 1) {
        $request = request(); // Obtém o objeto Request da requisição atual
        return app(ChamadoController::class)->dashboard($request); // Passa o Request como parâmetro
    }
    return redirect('/');
})->name('dashboard');

    
});
