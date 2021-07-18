<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Jwt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request){
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required'
        ]);
        $login = $request->input('login');
        $password = $request->input('password');

        $user = User::where('email', $login)->first();
        if(!$user){
            return response()->json(['message' => 'user is not found', 'errors' => ['login' => 'user is not found']], 403);
        }
        dd(new Jwt(Jwt::createAccessToken($user)));
    }
}
