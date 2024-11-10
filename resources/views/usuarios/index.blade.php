<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="/css/chamados/index.css">
</head>
<body>
@include('chamados.header')
    <div >
        <h1>Gerenciar Usuários</h1>

        <a href="{{ route('auth.register') }}">
    <button type="button" class="btn-abrir">Adicionar Usuário</button>
</a>
        @if($usuarios->isEmpty())
            <p>Nenhum usuário encontrado.</p>
        @else

        <div class="tabela">
        <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->userType->type_name }}</td>
                            <td>
                                <a href="{{ route('usuarios.editar', $usuario->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <a  class="btn btn-primary btn-sm">Chamados Abertos</a>
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
