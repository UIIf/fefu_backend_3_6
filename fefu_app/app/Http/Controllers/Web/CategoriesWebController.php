<?php

namespace App\Http\Controllers\Web;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
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

        $query = ProductCategory::query()->with('children');

        if ($slug === null) {
            $query->where('parent_id');
        }else{
            $query->where('slug', $slug);
        }
        return view('catalog.categories', ['categories' => $query->get()]);
    }
}