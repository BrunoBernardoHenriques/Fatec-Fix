<!-- resources/views/chamados/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/chamados/create.css"> 
    <title>Criar Chamado</title>
</head>


<body class="body_create">
    @include('chamados.header')

     <div class="div_centro">

    <form class="form_create" action="{{ route('chamados.store') }}" method="POST">     
        <h1>Criar Novo Chamado</h1>
        @csrf

        <label for="tipo_id">Tipo de Chamado:</label>
<select name="tipo_id" id="tipo_id" required>
    @foreach ($tipos as $tipo)
        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
    @endforeach
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

        <br>
    <a href="{{ route('chamados.index') }}">Voltar para a listagem de chamados</a>
    </form>
</div>
</body>
</html>
@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif