<link rel="stylesheet" href="/css/chamados/header.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<header class="header-index">

<h1>FatecFix</h1>

   
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Sair</button>
    </form>


</header>