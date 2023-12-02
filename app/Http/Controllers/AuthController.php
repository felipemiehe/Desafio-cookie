<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    public function register(Request $request)
    {

        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function firstpage(Request $request)
    {
        return response([
            'message' => 'Success'
        ],Response::HTTP_OK);
    }

    public function login(Request $request)
    {

        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message'=>'Credenciais inválidas'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*1.5); // 1h30min
        return response([
            'message' => 'success'
        ],Response::HTTP_OK)->withCookie($cookie);

    }

    public function logout(Request $request)    {

       if( request()->hasCookie('jwt')){
           if( $cookie =  Cookie::forget('jwt')){
               $request->user()->tokens()->delete();
               return response([
                   'message' => 'Success'
               ],Response::HTTP_OK)->withCookie($cookie);
           };
       }
        return response([
            'message' => 'Usuario não autenticado'
        ],Response::HTTP_BAD_REQUEST);

    }


}
