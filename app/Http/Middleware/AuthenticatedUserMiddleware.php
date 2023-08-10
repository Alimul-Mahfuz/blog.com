<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $id=$request->route('id');
        // if($request->url()==='http://127.0.0.1:8000/test-auth'){
        //     return redirect()->route('home');
        // }
        // if($id==10){
        //     return redirect()->route('home');
        // }
        // if($request->has('id')){
        //     //If the route has http://127.0.0.1:8000/test-auth/{id} if provide or not route always has
        //     //the id property if not passed than it will be empty. So this will be true.
        //     return redirect()->route('home');
        // }
        // if(!$request->has('name')){
        //     return redirect()->route('home');
        // }
        if(!Auth::check()){
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
