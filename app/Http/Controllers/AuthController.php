<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        // Obtém todos os tipos de usuário
        $userTypes = UserType::all(); 
    
        // Passa para a view 'auth.register'
        return view('auth.register', compact('userTypes'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'password' => 'required|string|min:8|confirmed',
              'type' => 'required|exists:user_types,id',
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'type' => $request->type,  
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            return redirect()->intended('chamados/');
        }

        return back()->withErrors(['name' => 'Credenciais inválidas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
