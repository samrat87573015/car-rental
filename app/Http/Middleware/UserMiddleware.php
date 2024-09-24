<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\JWTToken;

class UserMiddleware
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
            return redirect()->route('login');
        }else{
            $request->headers->set('userEmail', $data->userEmail);
            $request->headers->set('userId', $data->userId);
            return $next($request);
        }
    }
}
