<?php

namespace IPG\Handlers;

use IPG\Interfaces\CoreServiceInterface;

use IPG\DAO\DBStoreFactory;
use IPG\Handlers\DrupalPhpassHashedPasswordHandler;
use IPG\Utility\Cookie;
use IPG\Utility\Token;
use IPG\Config\Config;

class CoreDBHandler {

    private $_db;

    public function __construct() {
        
        $this->_db = DBStoreFactory::get('CoreStore');

    }

    public function login(?string $username = null, ?string $email = null, string $password) {

        $where = [];

        $passHandler = new DrupalPhpassHashedPasswordHandler(2);

        if(!empty($username)) $where['name'] = $username;
        if(!empty($email)) $where['mail'] = $email;

        $data = $this->_db->get('users_field_data', [
            'name', 'mail', 'pass'
        ], $where);

        $result = false;

        $result = $passHandler->check($password, $data['pass']);

        //Create session so other service knew user is logged in SSO.

        if($result == true) {

            //Stock token to cookie

            $token = Token::generate();

            Cookie::put(Config::getLoggedTokenName(), $token, Config::getLoggedTokenExpiry());

            //Maybe token should store in db too

        }

        return $result;

    }

    public function checkLogin(?string $username = null, ?string $email = null, string $password) : bool {

        $where = [];

        $passHandler = new DrupalPhpassHashedPasswordHandler(2);

        if(!empty($username)) $where['name'] = $username;
        if(!empty($email)) $where['mail'] = $email;
        

        $data = $this->_db->get('users_field_data',[
            'name', 'mail', 'pass'
        ], $where);

        $result = false;

        $result = $passHandler->check($password, $data['pass']);

        //Create session so other service knew user is logged in SSO.
        return $result;

    }

    public function getUserInfo(string $token) {

    }

    public function getUserResource(string $token) {

    }

}