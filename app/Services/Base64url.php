<?php


namespace App\Services;


class Base64url
{
    static public function encode($data)
    {
        $b64 = base64_encode($data);

        if ($b64 === false) {
            return false;
        }

        $url = strtr($b64, '+/', '-_');
        return rtrim($url, '=');
    }

    static public function decode($data, $strict = false)
    {
        $b64 = strtr($data, '-_', '+/');
        return base64_decode($b64, $strict);
    }
}