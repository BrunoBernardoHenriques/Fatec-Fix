<!-- resources/views/chamados/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Chamados</title>
</head>
<body>
    <h1>Bem-vindo ao sistema FatecFix</h1>

    <a href="{{ route('chamados.create') }}">
        <button type="button">Criar Novo Chamado</button>
    </a>

    <h2>Lista de Chamados</h2>

    @if($chamados->isEmpty())
        <p>Nenhum chamado foi encontrado.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descrição Resumida</th>
                    <th>Local</th>
                    <th>Solicitante</th>
                    <th>Status</th>
                    <th>Data de Abertura</th>
                    <th>Data de Encerramento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chamados as $chamado)
                    <tr>
                        <td>{{ $chamado->id }}</td>
                        <td>{{ $chamado->tipo }}</td>
                        <td>{{ $chamado->descricao_resumida }}</td>
                        <td>{{ $chamado->local->nome }}</td> <!-- Supondo que o campo que contém o nome no modelo Local é 'nome' -->
                        <td>{{ $chamado->solicitante }}</td>
                        <td>{{ $chamado->status ? $chamado->status->nome : 'Indefinido' }}</td>

                        <td>{{ \Carbon\Carbon::parse($chamado->data_abertura)->format('d/m/Y') }}</td>
                        <td>{{ $chamado->data_encerramento ? \Carbon\Carbon::parse($chamado->data_encerramento)->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('chamados.show', $chamado->id) }}">
                                <button type="button">Visualizar</button>
                            </a>
                            
                            <a href="{{ route('chamados.edit', $chamado->id) }}">
                    <button type="button">Editar</button>
                            </a>

                            <a href="{{ route('chamados.delete', $chamado->id) }}">
                            <button type="button">Eliminar</button>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
