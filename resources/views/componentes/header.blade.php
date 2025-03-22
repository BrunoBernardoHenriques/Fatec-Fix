<link rel="stylesheet" href="/css/componentes/header.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<header class="header-index">
    <h1 class="H1_HEADER">FatecFix</h1>

    <!-- Botão para abrir a sidebar -->
    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
    <i class="fa-solid fa-list-ul"></i>
    </button>
</header>

<!-- Sidebar usando Bootstrap Offcanvas (abertura na direita com 'offcanvas-end') -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
       <i>Menu</i>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group">
            <!-- Link para Todos os Chamados -->
            <li class="list-group-item">
                <a class="dropdown-item" href="{{ route('chamados.index') }}"> <i class="fa-solid fa-clipboard-list"></i> Todos os Chamados</a>
            </li>

            <!-- Links específicos para usuários administradores -->
            @if(auth()->user()->type == 1)
                <li class="list-group-item">
                    <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="fa-solid fa-users"></i> Gerenciar Usuários</a>
                </li>
                <li class="list-group-item">
                    <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-pie"></i> Gráficos</a>
                  
                </li>
            @endif

            <!-- Link para logout -->
            <li class="list-group-item">
                <a class="dropdown-item" href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       <i class="fa-solid fa-xmark" style="color: #dc3545;"></i>  Sair
               
                </a>
            </li>
        </ul>

        <!-- Formulário de logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
