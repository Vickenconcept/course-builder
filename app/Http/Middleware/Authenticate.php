<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
        if ($request->expectsJson()) {
            return null;
        }

        if (request()->routeIs('subscribe.show')) {
            // store the session
            session()->put('pending_subscription_route', $request->fullUrl());
        }
        // $currentRoute = Route::currentRouteName();
        // dd($currentRoute);

        // $redirectRoute = session('pending_subscription_route');
        // dd($redirectRoute);

        return route('login');
    }
}
