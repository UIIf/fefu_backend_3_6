<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Catalog\CategoryResource;
use App\Models\ProductCategory;
use App\OpenApi\Responses\Catalog\Categories\AllCategoriesResponse;
use App\OpenApi\Responses\Catalog\Categories\ShowCategoryResponse;
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
    #[OpenApi\Operation(tags: ['categories'], method: 'GET')]
    #[OpenApi\Response(factory: AllCategoriesResponse::class, statusCode: 200)]
    public function index( )
    {
        return CategoryResource::collection(
            ProductCategory::all()
        );
    }


     /**
     * Display Categories through slug.
     *
     * @param string $slug
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['categories'], method: 'GET')]
    #[OpenApi\Response(factory: ShowCategoryResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function show(string $slug)
    {
        return new CategoryResource(
            ProductCategory::query()->where('slug', $slug)->firstOrFail()
        );
    }

}