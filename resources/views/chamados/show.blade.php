<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Chamado</title>
    <script>
    

        function showUpdateDetails() {
            var select = document.getElementById("atualizacoes");
            var selectedOption = select.options[select.selectedIndex];
            var descricao = selectedOption.getAttribute("data-descricao");
            var data = selectedOption.getAttribute("data-data");
            var usuario = selectedOption.getAttribute("data-usuario");

            document.getElementById("descricao_atualizacao").innerText = descricao;
            document.getElementById("data_atualizacao").innerText = data;
            document.getElementById("usuario_atualizacao").innerText = usuario;
        }

        function toggleUpdateDropdown() {
            var dropdown = document.getElementById("update-dropdown");
            dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
        }
    </script>
</head>

@include('chamados.header')
<body>
    <h1>Detalhes do Chamado #{{ $chamado->id }}</h1>

   
    <p><strong>Tipo:</strong> {{ $chamado->tipo }}</p>
    <p><strong>Descrição Resumida:</strong> {{ $chamado->descricao_resumida }}</p>
    <p><strong>Descrição Completa:</strong> {{ $chamado->descricao_completa ?? 'N/A' }}</p>
    <p><strong>Local:</strong> {{ $chamado->local->nome }}</p>
    <p><strong>Solicitante:</strong> {{ $chamado->solicitante }}</p>
    <p><strong>Chamado Aberto Por:</strong> {{ $chamado->creator->name }}</p>
    <p><strong>Status:</strong> {{ $chamado->status->nome}}</p>
    <p><strong>Data de Abertura:</strong> {{ $chamado->data_abertura }}</p>
    <p><strong>Data de Encerramento:</strong> {{ $chamado->data_encerramento ?? 'N/A' }}</p>

    <h2>Atualizações do Chamado</h2>
    
    @if($chamado->atualizacoes->isNotEmpty()) <!-- Verifica se há atualizações -->
        <button onclick="toggleUpdateDropdown()">Mostrar Atualizações</button>
        
        <div id="update-dropdown" style="display: none; margin-top: 10px;">
            <label for="atualizacoes">Selecione uma Atualização:</label>
            <select name="atualizacoes" id="atualizacoes" onchange="showUpdateDetails()">
                <option value="">-- Selecione --</option>
                @foreach($chamado->atualizacoes as $atualizacao)
                    <option 
                        value="{{ $atualizacao->id }}" 
                        data-descricao="{{ $atualizacao->descricao }}"
                        data-data="{{ $atualizacao->created_at->format('d/m/Y H:i') }}" 
                        data-usuario="{{ $atualizacao->usuario->name }}">
                        Atualização em {{ $atualizacao->created_at->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>

            <div>
                <h3>Detalhes da Atualização</h3>
                <p><strong>Descrição:</strong> <span id="descricao_atualizacao">Selecione uma atualização para ver os detalhes.</span></p>
                <p><strong>Data:</strong> <span id="data_atualizacao"></span></p>
                <p><strong>Usuário:</strong> <span id="usuario_atualizacao"></span></p>
            </div>
        </div>
    @else
        <p>Nenhuma atualização disponível para este chamado.</p>
    @endif

    <br><br>

    <a href="{{ route('chamados.index') }}">
        <button type="button">Voltar para a Lista</button>
    </a>
</body>
</html>
