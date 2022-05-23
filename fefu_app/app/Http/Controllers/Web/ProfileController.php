<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Request $request){
        return view('profile', ['user' => (new UserResources(Auth::user()))->toArray($request)]);
    }
}
