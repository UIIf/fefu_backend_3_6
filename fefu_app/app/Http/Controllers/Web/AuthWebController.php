<?php

namespace App\Http\Controllers\Web;


use App\Http\Requests\BaseRegisterFormRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseLoginFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthWebController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function login(BaseLoginFormRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, true)) {
            $user = Auth::user();
            $user->app_logged_in_at = Carbon::now();
            $user->save();
            $request->session()->regenerate();
            return redirect(route('profile'));
        }

        return back()->with([
            'email' => 'invalid'
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }

    public function register(BaseRegisterFormRequest $request)
    {
        $data = $request->validated();

        $user = User::query()
            ->where('email', $data['email'])
            ->first();

        if ($user !== null) {
            $user = User::changeFromRequest($user, $data);
        } else {
            $user = User::createFromRequest($data);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('profile'));
    }
}