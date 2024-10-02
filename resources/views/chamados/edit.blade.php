<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Chamado</title>
</head>

<body>
@include('chamados.header')
    <h1>Editar Chamado #{{ $chamado->id }}</h1>

    <!-- Exibir mensagens de erro de validação -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('chamados.update', $chamado->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método para atualização -->
        
        <label for="tipo_id">Tipo de Chamado:</label>
<select name="tipo_id" id="tipo_id" required>
    @foreach ($tipos as $tipo)
        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
    @endforeach
</select>


        <br><br>

        <label for="descricao_resumida">Descrição Resumida:</label>
        <textarea name="descricao_resumida" id="descricao_resumida" required>{{ old('descricao_resumida', $chamado->descricao_resumida) }}</textarea>

        <br><br>

        <label for="descricao_completa">Descrição Completa:</label>
        <textarea name="descricao_completa" id="descricao_completa">{{ old('descricao_completa', $chamado->descricao_completa) }}</textarea>

        <br><br>

        <label for="local">Local:</label>
     <select name="local_id" id="local_id" required>
    @foreach ($locais as $local)
        <option value="{{ $local->id }}" {{ $chamado->local_id == $local->id ? 'selected' : '' }}>{{ $local->nome }}</option>
    @endforeach
      </select>


        <br><br>

        <label for="solicitante">Solicitante:</label>
        <input type="text" name="solicitante" id="solicitante" value="{{ old('solicitante', $chamado->solicitante) }}" required>

        <br><br>

        <label for="status_id">Status:</label>
        <select name="status_id" id="status_id" required>
            @foreach ($status as $status)
                <option value="{{ $status->id }}" {{ $chamado->status_id == $status->id ? 'selected' : '' }}>{{ $status->nome }}</option>
            @endforeach
        </select>

        <br><br>

        <label for="descricao_atualizacao">Atualizações de Chamado:</label>
        <textarea name="descricao_atualizacao" id="descricao_atualizacao" required></textarea>

        <br><br>

        <button type="submit">Atualizar Chamado</button>
    </form>

    <a href="{{ route('chamados.index') }}">Voltar para a listagem de chamados</a>
</body>
</html>
