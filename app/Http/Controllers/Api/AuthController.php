<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLogin;
use App\Http\Requests\UserRegister;
use App\Models\User;
use App\Http\Controllers\Api\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{use ApiResponse;
    public function register(UserRegister $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user',
        ]);

if($user){

                $token = $user->createToken('register_token')->plainTextToken;
                $user['token'] = $token;

         return $this->successResponse( $user);
            }else{
                return $this->errorResponse('Error in register');
            }}
        // $tid=$teacher->id();
        public function login(UserLogin $request) {
            $user=User::where('email',$request->email,'password',$request->password);
            if(!$user){
                return $this->errorResponse('Error in login or password');
            }else{
                $em = User::where('email', $request['email'])->firstOrFail();
                    $success['token'] = $em->createToken('apiToken')->plainTextToken;
                    $success['name'] = $em->name;
                    return $this->successResponse($success, 'User login successfully.');

            }








    }}
