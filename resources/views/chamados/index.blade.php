<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Chamados</title>
    <link rel="stylesheet" href="/css/chamados/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

   
</head>
<body>
    @include('componentes.header')

    <div class="index">
        <h2 class="h2">Lista de Chamados</h2>
        <a href="{{ route('chamados.create') }}">
            <button type="button" class="btn_abrir"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Abrir Chamado</button>
        </a>
        @include('componentes.filtro')
</div>

    @if($chamados->isEmpty())
        <p>Nenhum chamado foi encontrado.</p>
    @else
    <div class="table-responsive"  style="padding-left: 10px; padding-right: 10px;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 10%;">Tipo</th>
                <th style="width: 20%;">Descrição Resumida</th>
                <th style="width: 10%;">Local</th>
                <th style="width: 10%;">Solicitante</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Data de Abertura</th>
                <th style="width: 10%;">Data de Encerramento</th>
                <th style="width: 15%;" class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chamados as $chamado)
                <tr>
                    <td class="id">{{ $chamado->id }}</td>
                    <td class="nome">{{ $chamado->tipo->nome }}</td>
                    <td>{{ $chamado->descricao_resumida }}</td>
                    <td>{{ $chamado->local->nome }}</td>
                    <td>{{ $chamado->solicitante }}</td>

                    @if($chamado->status)
                        @if($chamado->status->id == 1)
                            <td><span class="badge badge-danger text-uppercase">{{ $chamado->status->nome }}</span></td>
                        @elseif($chamado->status->id == 2)
                            <td><span class="badge badge-alert text-uppercase">{{ $chamado->status->nome }}</span></td>
                        @elseif($chamado->status->id == 3)
                            <td><span class="badge badge-success text-uppercase">{{ $chamado->status->nome }}</span></td>
                        @else
                            <td>{{ $chamado->status->nome }}</td>
                        @endif
                    @endif

                    <td>{{ \Carbon\Carbon::parse($chamado->data_abertura)->format('d/m/Y') }}</td>
                    <td>{{ $chamado->data_encerramento ? \Carbon\Carbon::parse($chamado->data_encerramento)->format('d/m/Y') : 'N/A' }}</td>
                    <td class="acao">
                        <a href="{{ route('chamados.show', $chamado->id) }}">
                            <button type="button" class="btn-visualizar"><i class="fas fa-eye"></i> Visualizar</button>
                        </a>
                        <a href="{{ route('chamados.edit', $chamado->id) }}">
                            <button type="button" class="btn-editar"><i class="fas fa-pencil-alt"></i> Editar</button>
                        </a>
                        <a href="{{ route('chamados.delete', $chamado->id) }}">
                            <button type="button" class="btn-eliminar"><i class="fas fa-trash"></i> Eliminar</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
            <div class="pagination-container">
                {{ $chamados->links('chamados.pagination') }}
            </div>
        </div>
    @endif

    

</body>
</html>
