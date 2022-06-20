<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class OrderValidationErrorResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unprocessableEntity()->content(
            MediaType::json()->schema(
                Schema::object()->properties(
                    Schema::array('errors')->example([
                        'some inputs are required'
                    ])
                )
            )
        );
    }
}