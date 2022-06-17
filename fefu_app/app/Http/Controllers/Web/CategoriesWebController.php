<?php

namespace App\Http\Controllers\Web;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\CatalogFormRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoriesWebController extends Controller
{
    /**
     * Display Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CatalogFormRequest $request, string $slug = null): View|Factory|Application
    {
        $requestData = $request->validated();

        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        }else{
            $query->where('slug', $slug);
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

        $filters = ProductFilter::build($productQuery, $requestData['filters'] ?? []);
        ProductFilter::apply($productQuery, $requestData['filters'] ?? []);

        $sortMode = $requestData['sort_mode'] ?? null;
        if ($sortMode == 'price_asc' ){
            $productQuery->orderBy('price');
        } else if ($sortMode == 'price_desc'){
            $productQuery->orderBy('price', 'desc');
        }

        return view('catalog.categories', [
            'categories' => $categories,
            'products' => $productQuery->orderBy('products.id')->paginate(10),
            'filters' => $filters,
        ]);
    }
}