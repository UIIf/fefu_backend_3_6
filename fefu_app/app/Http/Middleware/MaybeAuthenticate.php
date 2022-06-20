<?php

namespace App\Http\Middleware;

class MaybeAuthenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    protected function authenticate($request, array $guards): void
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);
                break;
            }
        }
    }
}