<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserType; // Certifique-se de importar o modelo UserType

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
        $usuario = User::with('userType')->findOrFail($id); // Carrega o tipo de usuário
        $usertypes = UserType::all(); // Carrega todos os tipos de usuários da tabela correta

        return view('usuarios.edit', compact('usuario', 'usertypes'));
    }

    // Função para atualizar um usuário
    public function atualizarUsuario(Request $request, $id)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|exists:user_types,id', // Validar se o tipo existe na tabela user_types
            'password' => 'nullable|string|min:8|confirmed', // A senha é opcional, mas se fornecida, deve ser validada
        ]);

        // Atualiza o usuário no banco de dados
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->type = $request->type;

        // Se a senha for fornecida, atualiza a senha
        if ($request->has('password') && !empty($request->password)) {
            $usuario->password = Hash::make($request->password);
        }

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
