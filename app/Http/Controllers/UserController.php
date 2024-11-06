<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Função para exibir a lista de usuários (index)
    public function index()
    {
        // Carregar os usuários com o tipo de usuário relacionado
        $usuarios = User::with('userType')->paginate(15);
    
        return view('usuarios.index', compact('usuarios'));
    }
    

    // Função para editar um usuário
    public function editarUsuario($id)
    {
        // Encontra o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Retorna a view para editar as informações do usuário
        return view('usuarios.editar', compact('usuario'));
    }

    // Função para atualizar um usuário
    public function atualizarUsuario(Request $request, $id)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,user', // Supondo que você tenha um campo de papel para o usuário
        ]);

        // Atualiza o usuário no banco de dados
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role; // Atualiza o papel do usuário
        $usuario->save();

        // Redireciona com sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Função para excluir um usuário
    public function excluirUsuario($id)
    {
        // Encontra o usuário pelo ID e deleta
        $usuario = User::findOrFail($id);
        $usuario->delete();

        // Redireciona com sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
