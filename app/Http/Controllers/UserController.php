<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request){
        $user = new User;

        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();
        return response()->json($user, 201);
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if(!$user){
            return response()->json(['error' => 'user is not found'], 404);
        }
        if (Hash::check($password, $user->password)){
            Auth::login($user, true);

            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => 'wrong password'], 401);
        }
    }
}
