<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Cart </title>

</head>
    <body>
        Cart
        <table>
            @foreach($cart['items'] as $cartItem)
                <tr>
                    <td><a href="{{ route('product', ['slug' => $cartItem['product']['slug']]) }}"> {{$cartItem['product']['name']}} </a> </td>
                    <td> {{ $cartItem['quantity'] }} </td>
                    <td> {{ $cartItem['price_item'] }} руб.</td>
                    <td> {{ $cartItem['price_total'] }} руб.</td>
                </tr>
            @endforeach
        </table>
        <b>Итого: {{ $cart['price_total'] }} руб.</b>
    </body>
</html>
