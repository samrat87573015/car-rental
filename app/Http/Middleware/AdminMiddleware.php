<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\JWTToken;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $loginToken = $request->cookie('loginToken');
        $data = JWTToken::decodeToken($loginToken);


        if($data == "unauthorized"){
            // redirect 404 page
            (abort(404));
        }

        $user = User::find($data->userId);

        if(!$user || $user->role != 'admin'){
            (abort(404));
        }

        $request->headers->set('userEmail', $data->userEmail);
        $request->headers->set('userId', $data->userId);
        //return $admin;
        return $next($request);
       

    }
}
