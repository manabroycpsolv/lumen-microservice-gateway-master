<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
trait AccessToken
{
    /**
     * Required user email and password
     * return json
     */
    public function getTokenAndRefreshToken($email, $password) { 
        $client_id = env('CLIENT_ID');
        $client_secret = env('CLIENT_SECRET');
        $data = [
            'grant_type' => 'password',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'username' => $email,
            'password' => $password,
            'scope' => '*',
        ];
        $request = Request::create('/oauth/token', 'POST', $data);

        return app()->handle($request); 
    }

    public function getRefreshToken($refresh_token){
        $client_id = env('CLIENT_ID');
        $client_secret = env('CLIENT_SECRET');
        $data = [
            'grant_type' => 'refresh_token',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'scope' => '*',
        ];
        $request = Request::create('/oauth/token', 'POST', $data);

        return app()->handle($request); 
    }
}
