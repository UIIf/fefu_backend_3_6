<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\CatalogApiRequest;
use App\Http\Resources\Catalog\FullInfoProductResource;
use App\Http\Resources\Catalog\ShortInfoProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\OpenApi\Parameters\CategoryNameParameters;
use App\OpenApi\Parameters\ProductNameParameters;
use App\OpenApi\Responses\Catalog\Products\CategoryProductListResponse;
use App\OpenApi\Responses\Catalog\Products\ShowProductResponse;
use App\OpenApi\Responses\NotFoundResponse;
use Exception;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProductApiController extends Controller
{
    /**
     * Display product by slug.
     *
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['products'])]
    #[OpenApi\Parameters(factory: ProductNameParameters::class)]
    #[OpenApi\Response(factory: ShowProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function show(Request $request)
    {
        $productSlug = $request['product_slug'];


        $product = Product::query()
            ->with('productCategory','sortedAttributeValues.productAttribute')
            ->where('slug', $productSlug)
            ->first();

        if($product === null){
            abort(404);
        }

        return new FullInfoProductResource(
            $product
        );
    }

    /**
     * Display all products category.
     *
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['products'])]
    #[OpenApi\Parameters(factory: CategoryNameParameters::class)]
    #[OpenApi\Response(factory: CategoryProductListResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function index(CatalogApiRequest $request)
    {
        $requestData = $request->validated();

        $categorySlug = $requestData['category_slug'] ?? null;

        $query = ProductCategory::query()->with('children', 'products');

        if ($categorySlug === null) {
            $query->where('parent_id');
        }else{
            $query->where('slug', $categorySlug);
        }

        $categories = $query->get();

        try {
            $productQuery = ProductCategory::getTreeProductBuilder($categories);
        } catch (Exception $exception) {
            abort(422, $exception->getMessage());
        }

        $searchQuery = $requestData['search_query'] ?? null;
        if ($searchQuery !== null ){
            $productQuery->search($searchQuery);
        }

        ProductFilter::apply($productQuery, $requestData['filters'] ?? []);

        $sortMode = $requestData['sort_mode'] ?? null;
        if ($sortMode == 'price_asc' ){
            $productQuery->orderBy('price');
        } else if ($sortMode == 'price_desc'){
            $productQuery->orderBy('price', 'desc');
        }

        return ShortInfoProductResource::collection(
            $productQuery->orderBy('products.id')->paginate(10),
        );

    }
}