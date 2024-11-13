<!-- resources/views/chamados/delete.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Chamado</title>
    <link rel="stylesheet" href="/css/chamados/delete.css"> 
</head>

<body>
@include('componentes.header')


<div class="container">
 <div class="detalhes">
    <h1>Excluir Chamado #{{ $chamado->id }}</h1>

    <p><strong>Tipo:</strong> {{ $chamado->tipo->nome }}</p>
    <p><strong>Descrição Resumida:</strong> {{ $chamado->descricao_resumida }}</p>
    <p><strong>Descrição Completa:</strong> {{ $chamado->descricao_completa ?? 'N/A' }}</p>
    <p><strong>Local:</strong> {{ $chamado->local->nome }}</p>
    <p><strong>Solicitante:</strong> {{ $chamado->solicitante }}</p>
    <p><strong>Status:</strong> {{ $chamado->status->nome }}</p>
    <p><strong>Data de Abertura:</strong> {{ $chamado->created_at }}</p>
    <p><strong>Data de Encerramento:</strong> {{ $chamado->data_encerramento ?? 'N/A' }}</p>

    <p style="color: red;">Você tem certeza de que deseja apagar este chamado? Esta ação não pode ser desfeita.</p>

    <!-- Formulário para confirmar a exclusão -->
    <form action="{{ route('chamados.destroy', $chamado->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Sim, excluir chamado</button>
    </form>

    <br>

    <a href="{{ route('chamados.index') }}">Voltar para a listagem de chamados</a>
 
</body>
</html>
