<?php

namespace App\Http\Controllers\Web;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
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
    public function index(string $slug = null): View|Factory|Application
    {

        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        }else{
            $query->where('slug', $slug);
        }

        $categories = $query->get();

        try {
            $products = ProductCategory::getTreeProductBuilder($categories)
            ->orderBy('id')
            ->paginate();
        } catch (Exception $exception) {
            abort(422, $exception->getMessage());
        }

        return view('catalog.categories', ['categories' => $categories, 'products' => $products]);
    }
}