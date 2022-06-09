<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }}</title>
</head>
<body>
    <a href="{{route('categories', ['slug' => $product->productCategory->slug])}}">
        {{ $product->productCategory->name }}
    </a>
    <h1>{{ $product->name }}</h1>
    <p> {{ $product->price }}rub. </p>
    <p> {{ $product->description }} </p>

    <hr>
    <h4>Характеристики</h4>
    <table>
        @foreach($product->sortedAttributeValues as $attributeValue)
            <tr>
                <td>
                    <b>{{$attributeValue->productAttribute->name}}</b>
                </td>

                <td>
                    {{$attributeValue->value}}
                </td>
            </tr>
        @endforeach
    </table>

</body>
</html>