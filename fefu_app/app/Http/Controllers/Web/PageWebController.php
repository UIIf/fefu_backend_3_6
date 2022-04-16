<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     * @return Responsable
     */
    public function index()
    {
        $pageList = Page::paginate(5);
        return view('pageList', ['pageList' => $pageList]);
    }


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
