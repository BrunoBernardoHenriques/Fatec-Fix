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
            <button type="button" class="btn-abrir">Abrir Chamado</button>
        </a>
        @include('componentes.filtro')
</div>

    @if($chamados->isEmpty())
        <p>Nenhum chamado foi encontrado.</p>
    @else
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
                                    <button type="button" class="btn-editar">Editar</button>
                                </a>
                                <a href="{{ route('chamados.delete', $chamado->id) }}">
                                    <button type="button" class="btn-eliminar">Eliminar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $chamados->links('chamados.pagination') }}
            </div>
        </div>
    @endif

    <script>
    const filtrosSelecionados = {
        tipos: [],
        locais: [],
        status: []
    };

    function adicionarFiltro(tipo, label) {
        const select = document.getElementById(`${tipo}Select`);
        const valor = select.value;
        const texto = select.options[select.selectedIndex].text;

        // Evitar adicionar duplicatas
        if (!filtrosSelecionados[tipo].includes(valor)) {
            filtrosSelecionados[tipo].push(valor);
            mostrarFiltroSelecionado(tipo, label, valor, texto);
            atualizarInputsOcultos(tipo);
        }
    }

    function mostrarFiltroSelecionado(tipo, label, valor, texto) {
        const selectedFiltersContainer = document.getElementById('selectedFilters');
        const filterDiv = document.createElement('div');
        filterDiv.classList.add('selected-filter');
        filterDiv.innerHTML = `${label}: ${texto} <span onclick="removerFiltro('${tipo}', '${valor}', this)">×</span>`;
        selectedFiltersContainer.appendChild(filterDiv);
    }

    function removerFiltro(tipo, valor, elemento) {
        filtrosSelecionados[tipo] = filtrosSelecionados[tipo].filter(item => item !== valor);
        elemento.parentElement.remove();
        atualizarInputsOcultos(tipo);
    }

    function atualizarInputsOcultos(tipo) {
        const formulario = document.getElementById('filtroForm');

        // Remove inputs ocultos antigos do tipo específico
        const inputsAntigos = formulario.querySelectorAll(`input[name="${tipo}[]"]`);
        inputsAntigos.forEach(input => input.remove());

        // Adiciona novos inputs ocultos com os valores atualizados
        filtrosSelecionados[tipo].forEach(valor => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `${tipo}[]`;
            input.value = valor;
            formulario.appendChild(input);
        });
    }
</script>
<script>
    // Abrir o modal quando o botão "Filtros" for clicado
    document.getElementById('btn-filtros').addEventListener('click', function() {
        document.getElementById('filtrosModal').style.display = 'block';
    });

    // Fechar o modal ao clicar no "X" (span com id "closeModal")
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('filtrosModal').style.display = 'none';
    });

    // Fechar o modal ao clicar fora da área do modal
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('filtrosModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

</body>
</html>
