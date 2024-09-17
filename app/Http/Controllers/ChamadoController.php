<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chamados = Chamado::orderByRaw("FIELD(status, 'aberto', 'em andamento', 'encerrado')")
        ->orderBy('data_abertura', 'asc') // Opcional, ordena também pela data de abertura dentro de cada grupo
        ->get();
        return view('chamados.index', compact('chamados'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
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
    
        return view('chamados.create', compact('tipos_chamados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'tipo' => 'required|string',
        'descricao_resumida' => 'required|string',
        'descricao_completa' => 'nullable|string',
        'local' => 'required|string',
        'solicitante' => 'required|string',
        'status' => 'required|in:aberto,em andamento,encerrado',
    ]);

    $chamado = new Chamado;
    $chamado->tipo = $request->tipo;
    $chamado->descricao_resumida = $request->descricao_resumida;
    $chamado->descricao_completa = $request->descricao_completa;
    $chamado->local = $request->local;
    $chamado->solicitante = $request->solicitante;
    $chamado->data_abertura = now();
    $chamado->status = $request->status;
    $chamado->created_by = auth()->id(); // Registra o ID do usuário que criou o chamado
    $chamado->save();

    return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
}
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $chamado = Chamado::findOrFail($id); // Busca o chamado pelo ID
        return view('chamados.show', compact('chamado')); // Retorna a view com os dados do chamado
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chamado $chamado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aberto,em andamento,encerrado',
        ]);
    
        $chamado = Chamado::findOrFail($id);
        $chamado->status = $request->status;
    
        if ($request->status == 'encerrado') {
            $chamado->data_encerramento = now();
        } else {
            $chamado->data_encerramento = null; // Limpa a data de encerramento caso o status não seja "encerrado"
        }
        $chamado->updated_by = auth()->id();
        $chamado->save();
    
        return redirect()->route('chamados.show', $chamado->id)->with('success', 'Status atualizado com sucesso!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chamado $chamado)
    {
        //
    }
}
