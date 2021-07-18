<?php


namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Exception;


class Jwt
{
    private $jwt;
    private $payload;
    private $signature;
    private $verified;
    private $error = null;

    public function __construct($jwt)
    {
        $this->jwt = $jwt;
        $this->parseJWT($jwt);
    }

    private function parseJWT($jwt){
        list ($headers, $payload, $signature) = explode('.', $jwt);
        $this->payload = json_decode(Base64url::decode($payload));
        $this->signature = Base64url::decode($signature);
        $this->verified = true;
        if(hash_hmac('SHA256', $headers.'.'.$payload, ENV('JWT_KEY')) !== $this->signature ){
            $this->verified = false;
            $this->error = 'Подпись кривая';
        }
        if(Carbon::now()->timestamp > $this->payload->exp){
            $this->verified = false;
            $this->error = 'Токен протух';
        }
    }


    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception('Undefined property '.$property.' referenced.');
        }
    }

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
        $token = Base64url::encode(json_encode($headers)) . '.' . Base64url::encode(json_encode($payload)) . '.' . Base64url::encode($signature);

        return $token;
    }


}