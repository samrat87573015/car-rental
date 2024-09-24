<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\ResponsHelper;
use App\Helper\JWTToken;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{



    function loginPage(){
        return Inertia::render('Login');
    }

    function registerPage(){
        return Inertia::render('Register');
    }


    function register(Request $request){
        try{

            $data = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => $request->input('password'),
            ]);

            return ResponsHelper::out("success",$data,200);

        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
    }


    // function otpValidation(Request $request){

    //     $otp = $request->input('otp');
    //     $email = $request->input('email');
        
    //     $count = User::where('email','=',$email)->where('otp', '=',$otp)->select('id')->first();


    //     if($count !== null){
    //         User::where('email', $email)->update(['otp' => '0']);
    //         return ResponsHelper::out("Success","OTP Verified",200);
    //     }else{
    //         return ResponsHelper::out("failed","Wrong OTP",200);
    //     }
    // }


    function userLogin(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');

        $count = User::where('email', $email)->where('password', $password)->select('id')->first();

        $user = User::where('email', $email)->first();

        if($count !== null){
            $loginToken = JWTToken::generateToken($count->id,$email);

            $data = [
                'loginToken' => $loginToken,
                'isAdmin' => $user->isAdmin(),
                'isCustomer' => $user->isCustomer()
            ];

            return ResponsHelper::out("success",$data,200)->cookie('loginToken', $loginToken, 3600*24);

        }else{
            return ResponsHelper::out("failed","Wrong credentials",200);
        }

    }

    function logout(Request $request){
        return redirect('/login')->cookie('loginToken', '', -1);
    }

    function userCheck(Request $request){
        $user_id = $request->header('userId');
        $user = User::find($user_id);
        $userRole = $user->role;

        return [
            'userRole' => $userRole
        ];

    }


}
