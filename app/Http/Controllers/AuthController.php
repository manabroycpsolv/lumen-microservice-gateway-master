<?php

namespace App\Http\Controllers;

use App\Author;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;
use App\Traits\AccessToken;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser, AccessToken;
 
    /**
     * Return the access token and refresh token
     * @return Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);
        return $this->getTokenAndRefreshToken($user->email, $request->password);
    }

    /**
     * Return the access token and refresh token
     * @return Illuminate\Http\Response
     */
    public function signin(Request $request){
        $rules = [
            'password' => 'required',
            'email' => 'required|email',
        ];

        $this->validate($request, $rules);

        
        $email = $request->email;
        $password = $request->password;
        return $this->getTokenAndRefreshToken($email, $password);
        
    }

    /**
     * Return the access token and refresh token
     * @return Illuminate\Http\Response
     */
    public function refresh_token(Request $request){
        $rules = [
            'refresh_token' => 'required',
        ];

        $this->validate($request, $rules);

        
        $refresh_token = $request->refresh_token;
        return $this->getRefreshToken($refresh_token);
        
    }
}
