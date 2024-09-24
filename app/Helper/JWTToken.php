<?php 

namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTToken
{
    public static function generateToken($userId,$userEmail)
    {

        $key = env('JWT_KEY');
        $payload = array(
            "iss" => "JWT-Token",
            "iat" => time(),
            "exp" => time() + 60 * 60 * 24 * 7,
            "userId" => $userId,
            "userEmail" => $userEmail

        );
        return JWT::encode($payload, $key, 'HS256');

    }

    public static function decodeToken($token){

        try{

            if ($token == null){
                return "unauthorized";
            }else{
                $key = env('JWT_KEY');
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return $decoded;
            }
        }catch(\Exception $e){
            return "unauthorized";
        }
    }
}