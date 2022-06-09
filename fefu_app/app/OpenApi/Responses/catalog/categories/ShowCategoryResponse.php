<?php

namespace App\OpenApi\Responses\Catalog\Categories;

use App\OpenApi\Schemas\CategoriesSchema;
use App\OpenApi\Schemas\CategorySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema as ObjectsSchema;


class ShowCategoryResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    ObjectsSchema::object()->properties(
                        CategorySchema::ref('data')
                    )
                )
            );
    }
}