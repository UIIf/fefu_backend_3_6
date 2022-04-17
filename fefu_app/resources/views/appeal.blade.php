<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Обращение</title>

    </head>
    <body>
        <h1>
        Новое обращение
        </h1>
        @if ($success)
            <p>Обращение успешно отправленно</p>
        @endif
        <form method="POST" action="{{route('appeal.send')}}">
            @csrf
            <div>
                <label>Имя</label>
                <input  type="text" name="name" value="{{ old('name') }}" maxlength="255"/>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label>Телефон</label>
                <input  type="text" name="phone" value="{{ old('phone') }}" maxlength="255"/>
                @error('phone')
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
                <label>Message</label>
                <textarea name="message" value="{{ old('message') }}" maxlength="2000"></textarea>
                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input type="submit"/>
            </div>
        </form>
    </body>
</html>
