<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/usuarios/edit.css"> 
    <title>Editar Usuário</title>
</head>

<body class="body_edit">
@include('componentes.header')
    

    <!-- Exibir mensagens de erro de validação -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="div_centro">
   
    <form action="{{ route('usuarios.atualizar', $usuario->id) }}" method="POST" class="form_edit">
        @csrf
        @method('PUT') <!-- Método para atualização -->
        
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}" required>

        <br><br>

        <label for="type">Tipo de Usuário:</label>
        <select name="type" id="type" required>
            @foreach ($usertypes as $usertype)
                <option value="{{ $usertype->id }}" {{ $usuario->type == $usertype->id ? 'selected' : '' }}>{{ $usertype->type_name }}</option>
            @endforeach
        </select>

        <br><br>

        <label for="password">Nova Senha (Opcional):</label>
        <input type="password" name="password" id="password" placeholder="Digite a nova senha se quiser alterá-la" class="form-control">

        <label for="password_confirmation">Confirmar Senha (Opcional):</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme a nova senha" class="form-control">

        <br><br>

        <button type="submit">Atualizar Usuário</button>   
        <br>
        <a href="{{ route('usuarios.index') }}">Voltar para a listagem de usuários</a>
    </form>

    </div>
</body>
</html>
