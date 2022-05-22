<?php

namespace App\OpenApi\Responses\auth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class NotFoundUserResponses extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unauthorized()->description('Unauthorized');

    }
}