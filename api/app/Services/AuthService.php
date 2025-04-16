<?php



namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;



class AuthService
{


    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        $token = $user->createToken();


        return [
            'user' => $user,
            'token' => $token,
        ];
    }


    public function login(Request $request)
    {
        $creds = $request->only('email', 'password');

        $user = User::where('email', $creds['email'])->first();
        if (!$user || !password_verify($creds['password'], $user->password)) {
            return null;
        }
        $token = $user->createToken();

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}