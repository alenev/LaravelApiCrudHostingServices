<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Laravel\Passport\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LoginController extends Controller
{
   
    protected UserRepositoryInterface $userRepository;

    private $user;

    public function __construct(UserRepositoryInterface $userRepository){

       $this->userRepository = $userRepository;
       
    }


    public function login(UserLoginRequest $request):JsonResponse
    {
        if (isset($request->validator) && $request->validator->fails()) { 
  
             return Controller::apiResponceError($request->validator->errors()->first(), 422); 
  
        }else{

            $this->user = $this->userRepository->where('email', $request["email"]);

            if(empty($this->user)){

                return Controller::apiResponceError('User not found', 404); 

            }

            $password_check = Hash::check($request['password'],  $this->user->password);
                
            if(!$password_check) {
    
                return Controller::apiResponceError('Password mismatch', 422);
               
            }
    
            Passport::personalAccessTokensExpireIn(now()->addMinutes(env('USER_LOGIN_TOKEN_EXPIRES')));

            $token = $this->user->createToken('Login form');
                
            $bearerToken = $token->accessToken;
                 
            $bearerTokenExp = $token->token->expires_at->diffInMinutes(Carbon::now());
              
            $loginData = array(
                'bearerToken' => $bearerToken,
                'provider' => 'Login form', 
                'bearerTokenExp' => $bearerTokenExp
            );
       
            return Controller::apiResponceSuccess($loginData, 200);
         }
       
    }
}
