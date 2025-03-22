<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="/css/usuarios/index.css">
</head>
<body>
@include('componentes.header')
   <div class="index">
        <h2 class="h2">Lista de Usuários</h2>
        <a href="{{ route('auth.register') }}">
    <button type="button" class="btn_abrir"><i class="fa-solid fa-plus" style="color: #ffffff;"></i>Adicionar Usuário</button>
</a>
        @if($usuarios->isEmpty())
            <p>Nenhum usuário encontrado.</p>
        @else

    </div>
        <div class="table-responsive"  style="padding-left: 10px; padding-right: 10px;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th style="width: 15%;" class="acoes">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->userType->type_name }}</td>
                            <td class="acao">
                                <a href="{{ route('usuarios.editar', $usuario->id) }}" class="btn-editar"><i class="fas fa-pencil-alt"></i>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $usuarios->links() }}
            </div>
        @endif
    </div>
</body>
</html>
