<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Chamado;
use App\Models\Status; 
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        // Carrega os chamados junto com seus locais e status
        $chamados = Chamado::with(['local', 'status'])
            ->orderByRaw("FIELD(status_id, (SELECT id FROM status WHERE nome = 'aberto'), (SELECT id FROM status WHERE nome = 'em andamento'), (SELECT id FROM status WHERE nome = 'encerrado'))")
            ->orderBy('data_abertura', 'asc')
            ->get();

        return view('chamados.index', compact('chamados'));
    }



    public function create()
    {
        $tipos_chamados = [
            'Problema de Rede',
            'Acesso no Siga',
            'Acesso no Teams',
            'Problema no Computador',
            'Problema na Impressora',
            'Outros'
        ];
        
        $locais = Local::all();
        $status = Status::all(); // Obtém todos os status disponíveis
        return view('chamados.create', compact('tipos_chamados', 'locais', 'status'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descricao_resumida' => 'required|string',
            'descricao_completa' => 'nullable|string',
            'local_id' => 'required|exists:locais,id', // Validar se o ID do local existe
            'solicitante' => 'required|string',
            'status_id' => 'required|exists:status,id', // Altera para validar o ID do status
        ]);

        $chamado = new Chamado;
        $chamado->tipo = $request->tipo;
        $chamado->descricao_resumida = $request->descricao_resumida;
        $chamado->descricao_completa = $request->descricao_completa;
        $chamado->local_id = $request->local_id; // Atualiza para usar local_id
        $chamado->solicitante = $request->solicitante;
        $chamado->data_abertura = now();
        $chamado->status_id = $request->status_id; // Atualiza para usar status_id
        $chamado->created_by = auth()->id(); // Registra o ID do usuário que criou o chamado
        $chamado->save();

        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    public function show($id)
    {
        $chamado = Chamado::with('local', 'status')->findOrFail($id); // Busca o chamado pelo ID
        return view('chamados.show', compact('chamado')); // Retorna a view com os dados do chamado
    }

    public function delete($id)
    {
        $chamado = Chamado::findOrFail($id); // Busca o chamado pelo ID
        return view('chamados.delete', compact('chamado')); // Retorna a view com o chamado a ser deletado
    }

    public function destroy($id)
    {
        $chamado = Chamado::findOrFail($id);
        $chamado->delete(); // Deleta o chamado

        return redirect()->route('chamados.index')->with('success', 'Chamado excluído com sucesso!');
    }

    public function edit($id)
    {
        $chamado = Chamado::findOrFail($id);
        $locais = Local::all(); // Assume que você tem um modelo Local para pegar os locais
        $status = Status::all(); // Obtém todos os status disponíveis
        return view('chamados.edit', compact('chamado', 'locais', 'status'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descricao_resumida' => 'required|string',
            'descricao_completa' => 'nullable|string',
            'local_id' => 'required|exists:locais,id', // Verifica se o local existe
            'solicitante' => 'required|string',
            'status_id' => 'required|exists:status,id', // Altera para validar o ID do status
            'descricao_atualizacao' => 'required|string' // Validação da descrição da atualização
        ]);

        $chamado = Chamado::findOrFail($id);
        $chamado->tipo = $request->tipo;
        $chamado->descricao_resumida = $request->descricao_resumida;
        $chamado->descricao_completa = $request->descricao_completa;
        $chamado->local_id = $request->local_id; // Atualiza o ID do local
        $chamado->solicitante = $request->solicitante;
        $chamado->status_id = $request->status_id; // Atualiza para usar status_id
       
        $status = Status::find($request->status_id); // Encontre o status pelo ID

        if ($status && $status->nome === 'Encerrado') { // Verifica se o nome do status é "Encerrado"
            $chamado->data_encerramento = now();
        } else {
            $chamado->data_encerramento = null; // Limpa a data de encerramento caso o status não seja "Encerrado"
        }


        // Salva as informações atualizadas
        $chamado->save();

        // Cria uma nova atualização (caso você tenha implementado essa funcionalidade)
        $chamado->atualizacoes()->create([
            'descricao' => $request->descricao_atualizacao,
            'usuario_id' => auth()->id(), // Registra o usuário que fez a atualização
        ]);

        return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
    }
}
