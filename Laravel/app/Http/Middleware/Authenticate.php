<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
      if (!$request->expectsJson()) {
        if (Auth::guard('user')) {
          return route('frontend.auth.login');
        }else if (Auth::guard('admin')) {
          return route('login');
        }
      }
    }
}
