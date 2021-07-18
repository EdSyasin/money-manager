<?php


namespace App\Services;

use App\Models\User;
use Carbon\Carbon;


class Jwt
{
    static public function createAccessToken(User $user): string
    {
        return self::createToken($user, 15);
    }

    static public function createRefreshToken(User $user): string
    {
        return self::createToken($user, 43200);
    }

    static private function createToken(User $user, int $minutes): string
    {
        $headers = [
            'alg' => 'HS256',
            'typ' => 'jwt'
        ];
        $payload = [
            'id' => $user->id,
            'name' => "$user->first_name $user->last_name",
            "exp" => Carbon::now()->addMinutes($minutes)->timestamp,
            'iat' => Carbon::now()->timestamp
        ];
        $signature = hash_hmac('SHA256', Base64url::encode(json_encode($headers)) . '.' . Base64url::encode(json_encode($payload)), ENV('JWT_KEY'));
        $token = Base64url::encode(json_encode($headers)) . '.' . Base64url::encode(json_encode($payload)) . '.' . Base64url::encode(json_encode($signature));

        return $token;
    }


}