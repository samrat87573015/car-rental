<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Helper\ResponsHelper;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    function redirectToProvider($provider){

        return Socialite::driver($provider)->redirect();
    }


    function handleProviderCallback($provider){

        try{
            $socialUser  = Socialite::driver($provider)->user();
        
            // Check if the user exists in the database
            $user = User::where('provider_id', $socialUser->getId())->first();
    
            if(!$user){
    
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
    
                $loginToken = JWTToken::generateToken($user->id,$user->email);
    
                // login user in the application
                Auth::login($user);
    
                return redirect('/')->cookie('loginToken', $loginToken, 3600*24);
    
            }else{
                $loginToken = JWTToken::generateToken($user->id,$user->email);
                Auth::login($user);
                return redirect('/')->cookie('loginToken', $loginToken, 3600*24);
            }
        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }



    }


}
