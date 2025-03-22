<?php

namespace App\Http\Controllers;
use App\Models\Chamado;
use App\Models\TipoChamado;
use App\Models\Local;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index(Request $request)
{
    $query = Chamado::query();

    // Filtrar por tipo
    if ($request->has('tipos') && !empty($request->tipos)) {
        $query->whereIn('tipo_id', $request->tipos);
    }

    // Filtrar por local
    if ($request->has('locais') && !empty($request->locais)) {
        $query->whereIn('local_id', $request->locais);
    }

    // Filtrar por status
    if ($request->has('status') && !empty($request->status)) {
        $query->whereIn('status_id', $request->status);
    }

    // Filtrar por data mínima
    if ($request->has('data_minima') && $request->data_minima) {
        $query->whereDate('created_at', '>=', $request->data_minima);
    }

    // Filtrar por data máxima
    if ($request->has('data_maxima') && $request->data_maxima) {
        $query->whereDate('created_at', '<=', $request->data_maxima);
    }

    // Filtrar por usuário que criou o chamado
    if ($request->has('usuarios') && !empty($request->usuarios)) {
        $query->whereIn('created_by', $request->usuarios);
    }

    // Ordenar
    if ($request->input('ordem') === 'mais-recentes') {
        $query->orderBy('created_at', 'desc'); // Ordena por mais recentes
    } elseif ($request->input('ordem') === 'mais-antigos') {
        $query->orderBy('created_at', 'asc'); // Ordena por mais antigos
    }

    // Paginando os resultados com os filtros
    $chamados = $query->paginate(10)->appends($request->except('page'));

    // Carregar tipos, locais, status e usuários para a view
    $tipos = TipoChamado::all();
    $locais = Local::all();
    $statusList = Status::all(); // Carrega todos os status
    $usuarios = User::all(); // Assumindo que o nome da sua model de usuários é User

    return view('chamados.index', compact('chamados', 'tipos', 'locais', 'statusList', 'usuarios'));
}
    

    public function create()
    {
   
        $tipos = TipoChamado::all();
        $locais = Local::all();
        $status = Status::all(); // Obtém todos os status disponíveis
        return view('chamados.create', compact('tipos', 'locais', 'status'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tipo_id' => 'required|exists:tipos_chamado,id',
            'descricao_resumida' => 'required|string',
            'descricao_completa' => 'nullable|string',
            'local_id' => 'required|exists:locais,id', // Validar se o ID do local existe
            'solicitante' => 'required|string',
            'status_id' => 'required|exists:status,id', // Altera para validar o ID do status
        ]);

        $chamado = new Chamado;
        $chamado->tipo_id = $request->tipo_id;
        $chamado->descricao_resumida = $request->descricao_resumida;
        $chamado->descricao_completa = $request->descricao_completa;
        $chamado->local_id = $request->local_id; // Atualiza para usar local_id
        $chamado->solicitante = $request->solicitante;
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
        $tipos = TipoChamado::all();
        $locais = Local::all(); // Assume que você tem um modelo Local para pegar os locais
        $status = Status::all(); // Obtém todos os status disponíveis
        return view('chamados.edit', compact('chamado', 'locais', 'status','tipos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_id' => 'required|exists:tipos_chamado,id',
            'descricao_resumida' => 'required|string',
            'descricao_completa' => 'nullable|string',
            'local_id' => 'required|exists:locais,id', // Verifica se o local existe
            'solicitante' => 'required|string',
            'status_id' => 'required|exists:status,id', // Altera para validar o ID do status
            'descricao_atualizacao' => 'required|string' // Validação da descrição da atualização
        ]);

        $chamado = Chamado::findOrFail($id);
        $chamado->tipo_id = $request->tipo_id;
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
public function meusChamados()
{
    // Verifique se você tem um campo 'user_id' ou 'created_by' para associar o usuário aos chamados
    $chamados = Chamado::where('created_by', auth()->id())->paginate(15); // ou 'user_id', se for o caso
    return view('chamados.meus', compact('chamados'));
}


    public function gerenciarUsuarios()
{
    // Obtém todos os usuários para exibição
    $usuarios = User::paginate(15);

    return view('usuarios.gerenciar', compact('usuarios'));
}


public function dashboard(Request $request)
{
    $query = Chamado::query();

    // Aplicar filtros de mês e ano
    if ($request->has('month') && $request->month != '') {
        $query->whereMonth('chamados.created_at', $request->month); // Especificando que 'created_at' é da tabela 'chamados'
    }

    if ($request->has('year') && $request->year != '') {
        $query->whereYear('chamados.created_at', $request->year); // Especificando que 'created_at' é da tabela 'chamados'
    }

    // Obter os dados para os gráficos
    $tipoChamados = (clone $query)
    ->join('tipos_chamado', 'chamados.tipo_id', '=', 'tipos_chamado.id')
    ->selectRaw('tipos_chamado.nome as tipo, COUNT(*) as count')
    ->groupBy('tipos_chamado.nome')
    ->pluck('count', 'tipo');

$lugaresChamados = (clone $query)
    ->join('locais', 'chamados.local_id', '=', 'locais.id')
    ->selectRaw('locais.nome as place, COUNT(*) as count')
    ->groupBy('locais.nome')
    ->pluck('count', 'place');

$statusChamados = (clone $query)
    ->join('status', 'chamados.status_id', '=', 'status.id')
    ->selectRaw('status.nome as status_name, COUNT(*) as count')
    ->groupBy('status.nome')
    ->pluck('count', 'status_name');

    
    

    
    
    

    // Verificar se não há registros
    $noRecordsFound = $query->count() == 0;

    return view('chamados.dashboard', compact('tipoChamados', 'lugaresChamados', 'statusChamados', 'noRecordsFound'));
}






}
