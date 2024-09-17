<!-- resources/views/chamados/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Chamado</title>
    <script>
        // Redirecionar automaticamente após 4 segundos se houver uma mensagem de sucesso
        @if(session('success'))
            setTimeout(function() {
                window.location.href = "{{ route('chamados.index') }}";
            }, 4000); // 4 segundos
        @endif
    </script>
</head>
<body>
    <h1>Detalhes do Chamado #{{ $chamado->id }}</h1>

    <!-- Exibe a mensagem de sucesso -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>Tipo:</strong> {{ $chamado->tipo }}</p>
    <p><strong>Descrição Resumida:</strong> {{ $chamado->descricao_resumida }}</p>
    <p><strong>Descrição Completa:</strong> {{ $chamado->descricao_completa ?? 'N/A' }}</p>
    <p><strong>Local:</strong> {{ $chamado->local }}</p>
    <p><strong>Solicitante:</strong> {{ $chamado->solicitante }}</p>
    <p><strong>Chamado Aberto Por:</strong> {{  $chamado->creator->name}}</p>
    <p><strong>Status:</strong> {{ $chamado->status }}</p>
    <p><strong>Data de Abertura:</strong> {{ $chamado->data_abertura }}</p>
    <p><strong>Data de Encerramento:</strong> {{ $chamado->data_encerramento ?? 'N/A' }}</p>
    
    <!-- Formulário para atualizar o status -->
    <form action="{{ route('chamados.updateStatus', $chamado->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="status">Atualizar Status:</label>
        <select name="status" id="status" required>
            <option value="aberto" {{ $chamado->status == 'aberto' ? 'selected' : '' }}>Aberto</option>
            <option value="em andamento" {{ $chamado->status == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
            <option value="encerrado" {{ $chamado->status == 'encerrado' ? 'selected' : '' }}>Encerrado</option>
        </select>

        <br><br>

        <button type="submit">Atualizar Status</button>
    </form>

    <br><br>

    <a href="{{ route('chamados.index') }}">
        <button type="button">Voltar para a Lista</button>
    </a>
</body>
</html>
