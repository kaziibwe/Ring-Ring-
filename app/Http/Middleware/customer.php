<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->Session()->put('oldUrl', $request->url());

        if(!Auth::guard('customer')->check()){
            return redirect('/login');
        }

        // $user = Auth::guard('customer')->user();
        // if ($user && $user->customer && Session::has('oldUrl')) {
        //     $oldUrl = Session::pull('oldUrl');
        //     return redirect()->to($oldUrl);
        // }

        return $next($request);
    }
}
