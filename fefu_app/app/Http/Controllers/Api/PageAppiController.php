<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class PageAppiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['page'])]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\ListPageResponse::class, statusCode: 200)]
    public function index()
    {
        return PageResource::collection(
            Page::query()->paginate(5)
        );
    }

    

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['page'])]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\ShowPageResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\NotFoundResponse::class, statusCode: 404)]
    public function show(string $slug)
    {
        return new PageResource(
            Page::query()->where('slug',$slug)->firstOrFail()
        );
    }

    
}
