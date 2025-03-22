<link rel="stylesheet" href="/css/componentes/filtro.css">

<button type="button" id="btn-filtros" class="btn-abrir"><i class="fa-solid fa-sort"></i> Filtros</button>
 
    <style>
   
    </style>

    <div id="filtrosModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Filtrar Chamados</h3>
                <span id="closeModal" class="close">&times;</span>
            </div>
            <form id="filtroForm" method="GET" action="{{ route('chamados.index') }}" class="form-control">
                <!-- Ordenação -->
                <div class="form-group">
                    <label>Ordenar por:</label>
                    <select name="ordem" id="ordemSelect">
                        <option value="mais-recentes">Mais Recentes</option>
                        <option value="mais-antigos">Mais Antigos</option>
                    </select>
                </div>

                <!-- Tipos de Chamado -->
                <div class="form-group">
                    <label>Tipos de Chamado:</label>
                    <select id="tiposSelect">
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="adicionarFiltro('tipos', 'Tipos de Chamado')" class="btn-abrir">Adicionar Tipo</button>
                </div>

                <!-- Locais -->
                <div class="form-group">
                    <label>Locais:</label>
                    <select id="locaisSelect">
                        @foreach($locais as $local)
                            <option value="{{ $local->id }}">{{ $local->nome }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="adicionarFiltro('locais', 'Locais')" class="btn-abrir">Adicionar Local</button>
                </div>

                <!-- Status de Chamado -->
                <div class="form-group">
                    <label>Status de Chamado:</label>
                    <select id="statusSelect">
                        @foreach($statusList as $status)
                            <option value="{{ $status->id }}">{{ $status->nome }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="adicionarFiltro('status', 'Status de Chamado')" class="btn-abrir">Adicionar Status</button>
                </div>

<!-- Filtro por usuário que criou o chamado -->
<div class="form-group">
    <label>Criado por:</label>
    <select id="usuarioSelect"> <!-- id deve corresponder ao usado em adicionarUsuario -->
        <option value="">Selecione um usuário</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
        @endforeach
    </select>
    <button type="button" onclick="adicionarUsuario()" class="btn-abrir">Adicionar Usuário</button>
</div>




                <!-- Data Mínima e Máxima -->
                <div class="form-group">
                    <label>Data Mínima:</label>
                    <input type="date" name="data_minima">
                </div>

                <div class="form-group">
                    <label>Data Máxima:</label>
                    <input type="date" name="data_maxima">
                </div>

                <button type="submit" class="apply-filters">Aplicar Filtros</button>
            </form>

            <!-- Filtros Selecionados -->
            <div class="selected-filters" id="selectedFilters"></div>
        </div>
    </div>

    <script>
 const filtrosSelecionados = {
        tipos: [],
        locais: [],
        status: [],
        usuarios: []  // Campo para usuários
    };

    function adicionarFiltro(tipo, label) {
        const select = document.getElementById(`${tipo}Select`);
        const valor = select.value;
        const texto = select.options[select.selectedIndex].text;

        if (!filtrosSelecionados[tipo].includes(valor)) {
            filtrosSelecionados[tipo].push(valor);
            mostrarFiltroSelecionado(tipo, label, valor, texto);
            atualizarInputsOcultos(tipo);
        }
    }

    function adicionarUsuario() {
        const select = document.getElementById('usuarioSelect');
        const valor = select.value;
        const texto = select.options[select.selectedIndex].text;

        if (!filtrosSelecionados.usuarios.includes(valor) && valor) {
            filtrosSelecionados.usuarios.push(valor);
            mostrarFiltroSelecionado('usuarios', 'Usuário', valor, texto);
            atualizarInputsOcultos('usuarios');
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
        const inputsAntigos = formulario.querySelectorAll(`input[name="${tipo}[]"]`);
        inputsAntigos.forEach(input => input.remove());

        filtrosSelecionados[tipo].forEach(valor => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `${tipo}[]`;
            input.value = valor;
            formulario.appendChild(input);
        });
    }

    document.getElementById('btn-filtros').addEventListener('click', function() {
        document.getElementById('filtrosModal').style.display = 'block';
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('filtrosModal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('filtrosModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>