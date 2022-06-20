<?php

namespace App\OpenApi\Responses\cart;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class CartValidationErrorResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unprocessableEntity()->content(
            MediaType::json()->schema(
                Schema::object()->properties(
                    Schema::string('message')->example('The modifications field is required.'),
                    Schema::array('errors')->properties(
                        Schema::array('modifications')->example([
                            "The modifications field is required."
                        ])
                    )
                )
            )
        );
    }
}