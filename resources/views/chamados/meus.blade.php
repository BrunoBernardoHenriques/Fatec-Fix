<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Chamados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/chamados/index.css">
</head>
<body>
@include('chamados.header')

        <h2>Meus Chamados</h2>

        @if($chamados->isEmpty())
            <p>Nenhum chamado encontrado.</p>
        @else

        <h1>Meus Chamados Abertos</h1>
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
                        <td>{{ $chamado->local->nome }}</td>
                        <td>{{ $chamado->solicitante }}</td>
                        <td>{{ $chamado->status ? $chamado->status->nome : 'Indefinido' }}</td>

                        <td>{{ \Carbon\Carbon::parse($chamado->data_abertura)->format('d/m/Y') }}</td>
                        <td>{{ $chamado->data_encerramento ? \Carbon\Carbon::parse($chamado->data_encerramento)->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('chamados.show', $chamado->id) }}">
                                <button type="button" class="btn-visualizar">Visualizar</button>
                            </a>
                            
                            <a href="{{ route('chamados.edit', $chamado->id) }}">
                    <button type="button"class="btn-editar">Editar</button>
                            </a>

                            <a href="{{ route('chamados.delete', $chamado->id) }}">
                            <button type="button" class="btn-eliminar">Eliminar</button>

                    
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $chamados->links() }}
            </div>
        @endif
    </div>
</body>
</html>
