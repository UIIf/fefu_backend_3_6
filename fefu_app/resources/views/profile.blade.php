<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Profile </title>
</head>
<body>
    <h1>Profile</h1>
    <div>
        <h3>OAuth info:</h3>
        <h4>github:</h4>
        <label>
            <b> last login date: {{$user['github_logged_in_at'] ?? 'never'}}</b> <br>
            <b> registration date: {{$user['github_registered_at'] ?? 'never'}}</b>
        </label>
    </div>
    <div>
        <h4>google:</h4>
        <label>
            <b> last login date: {{$user['google_logged_in_at'] ?? 'never'}}</b> <br>
            <b> registration date: {{$user['google_registered_at'] ?? 'never'}}</b>
        </label>
    </div>
    <div>
        <h4>login through email:</h4>
        <label>
            <b> last login date: {{$user['app_logged_in_at'] ?? 'never'}}</b> <br>
            <b> registration date: {{$user['app_registered_at'] ?? 'never'}}</b>
        </label>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>