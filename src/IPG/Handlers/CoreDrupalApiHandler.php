<?php

namespace IPG\Handlers;

use IPG\Interfaces\CoreSystemServiceInterface;
use IPG\DAO\DBStoreFactory;
use IPG\Config\Config;

use Psr\Http\Message\ResponseInterface;

use GuzzleHttp\Client;

class CoreDrupalApiHandler implements CoreSystemServiceInterface {

    private $_clinet, $_identityStore;

    public function __construct() {
        
        $this->_client = new Client();

        $this->_identityStore = DBStoreFactory::get('IdentityStore');

    }

    public function login(?string $username, ?string $email, string $password) {

        //Drupal 8 rest api doesn't support login with email, an custom end point might needed.

        $response = $this->_client->post(
            Config::get('core_server.domain').'/user/login?_format=json
            ', [
            'json'=> [
                'name'=> $username,
                'pass'=> $password
            ]
        ]);

        return $response->getBody();

    }

    public function checkLogin(?string $username, ?string $email, string $password): bool
    {

        

        $result = false;

        return $result;
    }

    public function getUserInfo($token) : ResponseInterface {
        
        // $loggedInfo = $this->_identityStore->get('logged_token', ['token', 'user_info_id', 'expiry'], ['token'=> $token]);

        $path = Config::get('core_server.domain').Config::get('core_server.api_call.user_resource')."/{$token}";

        $response = $this->_client->request('GET', $path);

        return $response->getBody();

    }

    public function getUserResource($token) {

        $path = Config::get('core_server.domain').Config::get('core_server.api_call.user_resource')."/{$token}";

        $response = $this->_client->request('GET', $path);

        return $response->getBody();

    }

}