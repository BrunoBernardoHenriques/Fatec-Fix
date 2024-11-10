<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="/css/auth/register.css">
</head>
<body class="register-body">
@include('chamados.header')

<div class="register-container">
    <h1>Registrar</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('auth.register') }}" method="POST" class="register-form">

        @csrf
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required class="form-control">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required class="form-control">
        <br>
        <label for="password_confirmation">Confirme a Senha:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
        <br>

     <!-- Select para o tipo de usuário -->
<label for="type">Tipo de Usuário:</label>
<select id="type" name="type" required>
    @foreach($userTypes as $type)
        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
    @endforeach
</select>        
<br>
<br>

        
        <button type="submit">Registrar</button>

        <a href="{{ route('chamados.index') }}">Voltar para a listagem de chamados</a>
    </form>
    </div>

</body>
</html>
