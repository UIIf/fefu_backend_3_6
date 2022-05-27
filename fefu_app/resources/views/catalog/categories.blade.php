<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog</title>
</head>
<body>
    Catalog
    @include('catalog.category_list', ['categories', $categories])
</body>
</html>