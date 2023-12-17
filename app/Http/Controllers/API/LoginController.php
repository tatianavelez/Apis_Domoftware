<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class LoginController extends Controller
{

//Registro

    public function registroapi(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
        ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer', ]);
    }


//Login
public function loginapi(Request $request)
{
    if (!Auth::attempt($request->only('email', 'password'))) 
    {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = User::where('email', $request['email'])->firstOrFail();

    $user->tokens()->delete();

    $sanctumToken = $user->createToken('auth_token', ['expires_in' => 3600]);

    $token = $sanctumToken->plainTextToken;

    $user->tokens()->create([
        'name' => 'auth_token',
        'token' => $token,
        'abilities' => ['*'],
        'expires_at' => now()->addSeconds(3600),
    ]);

    return response()->json([
        'message' => 'Hi ' . $user->name,
        'accessToken' => $token,
        'token_type' => 'Bearer',
        'user' => $user,
    ]);
}


//   public function logout()
//   {
//     auth()->user()->tokens()->delete();
    
//     return[
//         'message'=>'Revocado con exito' 
//     ];

//   }


  public function logout(Request $request)
  {
      $request->session()->invalidate();
      $request->session()->regenerateToken();
  
        return[
        'message'=>'Revocado con exito' 
        ];
  }



}
