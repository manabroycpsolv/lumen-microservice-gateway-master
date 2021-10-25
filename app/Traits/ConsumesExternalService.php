<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
trait ConsumesExternalService
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);

        return $response->getBody()->getContents();
    }

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
       
        // return $http->post($base_url.'/oauth/token', $data);
        $request = Request::create('/oauth/token', 'POST', $data);

        return app()->handle($request); 
    }
}
