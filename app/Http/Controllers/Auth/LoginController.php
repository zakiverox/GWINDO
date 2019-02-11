<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Respons\ApiCode;

use App\MyResponseBuilder;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Dingo\Api\Exception\StoreResourceFailedException;
use App\Role;

class LoginController extends Controller
{
    use Helpers;
    
    public function authenticate(Request $request)
    {
        $rules = [
            'email' => ['required', 'alpha'],
            'password' => ['required', 'min:7']
        ];
               // grab credentials from the request
               $credentials = $request->only('email', 'password');

              

               try {
                   // attempt to verify the credentials and create a token for the user
                   if (! $token = JWTAuth::attempt($credentials)) {
                       return $this->response->array(['error' => 'invalid_credentials'], 401);
                   }
               } catch (JWTException $e) {
                   // something went wrong whilst attempting to encode the token
                   return $this->response->error(['error' => 'could_not_create_token'], 500);
               }
       
               // all good so return the token
               return $this->response->array(compact('token'))->setStatusCode(201);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        
         JWTAuth::invalidate($request->input('token'));
         return $request->input('token');
    }

    public function register(Request $request)
    {
        $this->validate($request,[
 
         'name' => 'required|unique:users',
         'email' => 'required|unique:users',
         'password' => 'required',
        ]);
 
        return User::create([
 
            'name' => $request->json('name'),
        'email' => $request->json('email'),
        'password' => bcrypt($request->json('password')),
        ]);
    
 }

 
 public function show()
 {
            try {
                 if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
                   }
             } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                  return response()->json(['token_expired'], $e->getStatusCode());
              } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                 return response()->json(['token_invalid'], $e->getStatusCode());
             } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                 return response()->json(['token_absent'], $e->getStatusCode());
                }
    // the token is valid and we have found the user via the sub claim
            return $this->response->item($user, new UserTransformer)->setStatusCode(200);
}

public function getToken()
{
    $token = JWTAuth::getToken();
        if (!$token) {
            return $this->response->errorMethodNotAllowed('Token not provided');
        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->response->errorInternal('Not able to refresh Token');
        }
        return $this->response->withArray(['token' => $refreshedToken]);

}
public function profile()
{
    if (!$user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
               }
            $user1 = User::find($user->id);
           
          

            return $this->response->item($user, new UserTransformer)->setStatusCode(200);


   

}
}
