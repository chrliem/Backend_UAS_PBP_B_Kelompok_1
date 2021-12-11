<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    use VerifiesEmails;

    public function register(Request $request)
    {
        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
           'name' => 'required|max:60',
           'email'=> 'required|email:rfc,dns|unique:users',
           'username'=> 'required|unique:users',
           'password' => 'required|min:6',
           'imgURL' 
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $registrationData['password'] = bcrypt($request->password);
        $user = User:: create($registrationData);
        $user->sendApiEmailVerificationNotification();
        return response([
            'message' => 'Berhasil register akun! Silahkan lakukan aktivasi email',
            'user' => $user
        ], 200);
    } 

    public function login(Request $request)
    {
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        if(!Auth::attempt($loginData)) return response(['message' => 'Username / Password Salah'], 401);
        
        $user = Auth::user();

        if($user->email_verified_at !== NULL)
        {
            $token = $user->createToken('Authentication Token')->accessToken;
            
            return response([
                'message' => 'Login Berhasil',
                'user' => $user,
                'token_type' => 'Bearer',
                'access_token' => $token
            ]);
        }
        else
        {
            return response(['message' => 'Silahkan Verifikasi Akun'], 401);
        }
    }
}