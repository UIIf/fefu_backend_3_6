<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\OpenApi\Responses\ShowNewsResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class NewsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ListNewsResponse::class, statusCode:200)]
    public function index()
    {
        return NewsResource::collection(
            News::all()
        );
    }

    

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ShowNewsResponse::class, statusCode:200)]
    public function show(string $slug)
    {
        return new NewsResource(
            News::query()->where('slug',$slug)->firstOrFail()
        );
    }

    
}
