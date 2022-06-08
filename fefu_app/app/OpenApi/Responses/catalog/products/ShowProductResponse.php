<?php

namespace App\OpenApi\Responses\catalog\products;

use App\OpenApi\Schemas\FullInfoProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ShowProductResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(Schema::object()->properties(
                    FullInfoProductSchema::ref('data')
                ))
            );
    }
}