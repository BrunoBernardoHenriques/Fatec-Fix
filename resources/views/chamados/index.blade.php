<!-- resources/views/chamados/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Chamados</title>
    <link rel="stylesheet" href="/css/chamados/index.css">
</head>



<body>
@include('chamados.header')



    <h2>Lista de Chamados</h2>

    <a href="{{ route('chamados.create') }}">
        <button type="button" class="btn-abrir">Abrir Chamado</button>
    </a>

    @if($chamados->isEmpty())
        <p>Nenhum chamado foi encontrado.</p>
    @else

</div>
    <div class="tabela">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descrição Resumida</th>
                    <th>Local</th>
                    <th>Solicitante</th>
                    <th>Status</th>
                    <th>Data de Abertura</th>
                    <th>Data de Encerramento</th>
                    <th class="acoes">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chamados as $chamado)
                    <tr>
                        <td>{{ $chamado->id }}</td>
                        <td>{{ $chamado->tipo->nome }}</td>
                        <td>{{ $chamado->descricao_resumida }}</td>
                        <td>{{ $chamado->local->nome }}</td> <!-- Supondo que o campo que contém o nome no modelo Local é 'nome' -->
                        <td>{{ $chamado->solicitante }}</td>
                        <td>{{ $chamado->status ? $chamado->status->nome : 'Indefinido' }}</td>

                        <td>{{ \Carbon\Carbon::parse($chamado->data_abertura)->format('d/m/Y') }}</td>
                        <td>{{ $chamado->data_encerramento ? \Carbon\Carbon::parse($chamado->data_encerramento)->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('chamados.show', $chamado->id) }}" style="text-decoration: none;">
                                <button type="button" class="btn-visualizar">Visualizar</button>
                            </a>
                            
                            <a href="{{ route('chamados.edit', $chamado->id) }}" style="text-decoration: none;">
                    <button type="button"class="btn-editar">Editar</button>
                            </a>

                            <a href="{{ route('chamados.delete', $chamado->id) }}" style="text-decoration: none;">
                            <button type="button" class="btn-eliminar">Eliminar</button>

                    </tr>
                @endforeach
            </tbody>
        </table>    
        <div class="pagination-container">
            {{ $chamados->links('chamados.pagination') }}
        </div>

    @endif


</div>
</body>
</html>
