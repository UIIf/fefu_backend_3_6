<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $slug)
    {
        $page = Page::query()
            // ->where([
            //     ['slug',$slug],
            //     ])
            ->where('slug','=',$slug)
            ->first();
        if($page === null)
            abort(404);
        
        return  view('page',['page' => $page]);
    }
}
