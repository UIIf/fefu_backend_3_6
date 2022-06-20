<?php

namespace App\OpenApi\Responses\cart;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class EmptyCartResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unprocessableEntity()->description('cart is empty');
    }
}