<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $request->Session()->put('oldUrl', $request->url());
        // if (!auth()->check()) {
        //     Session::put('oldUrl', $request->url());
        // }

        return $request->expectsJson() ? null : route('front.login');

        // if(!$request->expectsJson()){
        //     if($request->routeIs('admin.*')){
        //         session()->flash('fail','you must login first');
        //         return route('admin.login');
        //     }
        // }
    }
}
