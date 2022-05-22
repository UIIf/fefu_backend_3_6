<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
</head>
<body>
    <h1>
        Регистрация
    </h1>
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div>
            <label>Name</label>
            <input  type="text" name="name" value="{{ old('name') }}" maxlength="255"/>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>E-mail</label>
            <input  type="text" name="email" value="{{ old('email') }}" maxlength="255"/>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Password</label>
            <input name="password" value="{{ old('password') }}" maxlength="2000"/>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="submit"/>
        </div>
    </form>
</body>
</html>