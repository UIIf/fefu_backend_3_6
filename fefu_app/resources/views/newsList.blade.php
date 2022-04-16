<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>News list</title>
</head>
<body>
    @foreach($newsList as $news)
        <h1>{{ $news->title }}</h1>
        <p>{{ $news->text }}</p>
        <h5>{{ $news->published_at }}</h5>
    @endforeach

    <h3>{{ $newsList->links('pagination::semantic-ui') }}</h3>

</body>
</html>