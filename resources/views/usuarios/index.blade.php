<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
@include('chamados.header')
    <div class="container mt-3">
        <h1>Gerenciar Usuários</h1>

        <a href="{{ route('auth.register') }}">
    <button type="button" class="btn-abrir">Adicionar Usuário</button>
</a>
        @if($usuarios->isEmpty())
            <p>Nenhum usuário encontrado.</p>
        @else
            <table class="table table-striped table-bordered">
                <thead>
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
                                <a  class="btn btn-danger btn-sm">Excluir</a>
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
