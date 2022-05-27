<?php

namespace App\OpenApi\Responses\catalog;

use App\OpenApi\Schemas\CategoriesSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema as ObjectsSchema;


class ShowCategoriesResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    ObjectsSchema::object()->properties(
                        CategoriesSchema::ref('data')
                    )
                )
            );
    }
}