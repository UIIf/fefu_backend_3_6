<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResources;
use App\Models\ProductCategory;
use App\OpenApi\Responses\catalog\AllCategoriesResponse;
use App\OpenApi\Responses\catalog\ShowCategoriesResponse;
use App\OpenApi\Responses\NotFoundResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CategoriesApiController extends Controller
{
    /**
     * Display categories.
     *
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['categories'])]
    #[OpenApi\Response(factory: AllCategoriesResponse::class, statusCode: 200)]
    public function index( )
    {
        return CategoriesResources::collection(
            ProductCategory::all()
        );
    }


     /**
     * Display Categories through slug.
     *
     * @param string $slug
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['categories'])]
    #[OpenApi\Response(factory: ShowCategoriesResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function show(string $slug)
    {
        return new CategoriesResources(
            ProductCategory::query()->where('slug', $slug)->firstOrFail()
        );
    }

}