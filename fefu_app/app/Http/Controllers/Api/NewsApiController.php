<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class NewsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['news'])]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\ListNewsResponse::class, statusCode: 200)]
    public function index()
    {
        return NewsResource::collection(
            News::query()->published()->paginate(5)
        );
    }

    

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['news'])]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\ShowNewsResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\NotFoundResponse::class, statusCode: 404)]
    public function show(string $slug)
    {
        return new NewsResource(
            News::query()->published()->where('slug',$slug)->firstOrFail()
        );
    }

    
}
