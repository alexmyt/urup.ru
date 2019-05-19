<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
  /**
   * Create user
   *
   * @param  [string] name
   * @param  [string] email
   * @param  [string] password
   * @return [string] message
   */
  public function register(Request $request)
  {
      $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string'
      ]);
      $user = new User([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password)
      ]);
      $user->save();
      return response()->json([
          'message' => 'Successfully created user!'
      ], 201);
  }
  
  /**
   * Login user and create token
   *
   * @param  [string] email
   * @param  [string] password
   * @param  [boolean] remember_me
   * @return [string] access_token
   * @return [string] token_type
   * @return [string] expires_at
   */  
  public function login (Request $request) {

    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
      'remember_me' => 'boolean'
    ]);
            
    $user = User::where('email', $request->email)->first();

    if ($user) {

      if (Hash::check($request->password, $user->password)) {
        $tokenResult = $user->createToken('Laravel Password Grant Client');
        
        $response = ['token' => $tokenResult->accessToken,
                     'token_type' => 'bearer',
                     'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                    ];
        
        return response()->json($response, 200)->withHeaders([
            'Authorization' => $tokenResult->accessToken,
            'Access-Control-Allow-Headers' => 'Authorization',
            'Access-Control-Expose-Headers' => 'Authorization'
            ]
        );
      } else {
        $response = ['error' => __('auth.failed')];
        return response()->json($response, 422);
      }

    } else {
      $response = ['error' => __('auth.failed')];
      return response()->json($response, 404); 
    }
  
  }

  /**
   * Logout user (Revoke the token)
   *
   * @return [string] message
   */
  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }  
}
