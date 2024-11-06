<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
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

    <form action="{{ route('auth.register') }}" method="POST">

        @csrf
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="password_confirmation">Confirme a Senha:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br>

     <!-- Select para o tipo de usuário -->
<label for="type">Tipo de Usuário:</label>
<select id="type" name="type" required>
    @foreach($userTypes as $type)
        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
    @endforeach
</select>
<br>

        
        <button type="submit">Registrar</button>
    </form>

    <a href="{{ route('login') }}">Login</a>
</body>
</html>
