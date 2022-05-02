<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Responsable
     *
     */
    public function show(string $slug)
    {
        $page = Page::query()
            ->where('slug', $slug)->first();

        if ($page === null) {
            abort(404);
        }
        return view('page', ['page' => $page]);
    }
}
