<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Chamados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <h1>Meus Chamados</h1>

        @if($chamados->isEmpty())
            <p>Nenhum chamado encontrado.</p>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descrição Resumida</th>
                        <th>Local</th>
                        <th>Status</th>
                        <th>Data de Abertura</th>
                        <th>Data de Encerramento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chamados as $chamado)
                        <tr>
                            <td>{{ $chamado->id }}</td>
                            <td>{{ $chamado->tipo }}</td>
                            <td>{{ $chamado->descricao_resumida }}</td>
                            <td>{{ $chamado->local->nome }}</td>
                            <td>{{ $chamado->status->nome }}</td>
                            <td>{{ $chamado->data_abertura }}</td>
                            <td>{{ $chamado->data_encerramento ?? 'N/A' }}</td>
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
