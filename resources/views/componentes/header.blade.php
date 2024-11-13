<link rel="stylesheet" href="/css/componentes/header.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<header class="header-index">

<h1 class="H1_HEADER">FatecFix</h1>

   
 
<div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <ul class="dropdown-menu" aria-labelledby="userMenuButton">
            <li><a class="dropdown-item" href="{{ route('chamados.index') }}">Todos os Chamados</a></li>
                <!-- Opção para visualizar chamados do usuário atual -->
                <li><a class="dropdown-item" href="{{ route('chamados.meus') }}">Meus Chamados</a></li>

                
                <!-- Opção para logout -->
             
                
                <!-- Condição para exibir "Gerenciar Usuários" somente se o tipo do usuário for 1 -->
                @if(auth()->user()->type == 1)
                    <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Gerenciar Usuários</a></li>  
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Graficos</a></li>  
                @endif
                <li><a class="dropdown-item" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                </a></li>
            </ul>
        </div>






        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</div>

</header>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>