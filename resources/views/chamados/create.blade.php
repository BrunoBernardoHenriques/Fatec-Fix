<!-- resources/views/chamados/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Chamado</title>
</head>
<body>
    <h1>Criar Novo Chamado</h1>

    <form action="{{ route('chamados.store') }}" method="POST">
        @csrf
        <label for="tipo">Tipo de Chamado:</label>
        <select name="tipo" id="tipo" required>
            <option value="Problema de Rede">Problema de Rede</option>
            <option value="Acesso no Siga">Acesso no Siga</option>
            <option value="Acesso no Teams">Acesso no Teams</option>
            <option value="Problema no Computador">Problema no Computador</option>
            <option value="Problema na Impressora">Problema na Impressora</option>
            <option value="Outros">Outros</option>
        </select>

        <br><br>

        <label for="local_id">Local:</label>
        <select name="local_id" id="local_id" required>
            @foreach ($locais as $local)
                <option value="{{ $local->id }}">{{ $local->nome }}</option>
            @endforeach
        </select>
       <br><br>



        <label for="descricao_resumida">Descrição Resumida:</label>
        <textarea name="descricao_resumida" id="descricao_resumida" required></textarea>

        <br><br>

        <label for="descricao_completa">Descrição Completa:</label>
        <textarea name="descricao_completa" id="descricao_completa"></textarea>

        <br><br>

        <label for="solicitante">Solicitante:</label>
        <input type="text" name="solicitante" id="solicitante" required>

        <br><br>

        <label for="status_id">Status:</label>
        <select name="status_id" id="status_id" required>
            @foreach ($status as $status)
                <option value="{{ $status->id }}">{{ $status->nome }}</option>
            @endforeach
        </select>

        <br><br>

        <button type="submit">Criar Chamado</button>
    </form>

    <a href="{{ route('chamados.index') }}">Voltar para a listagem de chamados</a>
</body>
</html>
