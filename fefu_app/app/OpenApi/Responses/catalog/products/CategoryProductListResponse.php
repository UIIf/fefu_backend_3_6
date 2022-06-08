<?php

namespace App\OpenApi\Responses\catalog\products;

use App\OpenApi\Schemas\FullInfoProductSchema;
use App\OpenApi\Schemas\PaginatorLinksSchema;
use App\OpenApi\Schemas\PaginatorMetaSchema;
use App\OpenApi\Schemas\ProductsCatalogSchema;
use App\OpenApi\Schemas\ShortInfoProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class CategoryProductListResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::object()->properties(
                        Schema::array('data')->items(ShortInfoProductSchema::ref()),
                        PaginatorLinksSchema::ref('links'),
                        PaginatorMetaSchema::ref('meta'),
                    )
                )
            );
    }
}