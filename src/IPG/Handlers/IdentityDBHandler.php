<?php

namespace IPG\Handlers;

use IPG\Config\Config;
use IPG\DAO\DBStoreFactory;

use Zend\Diactoros\Request;

class IdentityDBHandler {

    private $_db;

    public function __construct() {
        
        $this->_db = DBStoreFactory::get('CoreStore');

    }

    public function checkLogin(string $token) {

        //Check if token existing and not expired
        $loggedInfo = $this->_db->get('logged_token', [
            'token', 'user_info_id', 'expiry'
        ],[
            'token'=> $token
        ]);

        $now = time();

        if($loggedInfo && $loggedInfo['expiry'] > $now) {
            $userInfo = $this->_db->get('user_info', [
                'id', 'user_id', 'username', 'email'
            ],[
                'id'=> $loggedInfo['user_info_id']
            ]);

            
        }

    }

    public function getUserInfo($token) {
        
        $loggedInfo = $this->_db->get('logged_token', ['token', 'user_info_id', 'expiry'], ['token'=> $token]);

        $userInfo = $this->_db->get('user_info', ['user_id', 'username', 'email'], ['id'=> $loggedInfo['user_info_id']]);

        return $userInfo;

    }

    public function getUserResource($token) {

        $resource = [];

        $loggedInfo = $this->_db->get('logged_token', ['token', 'user_info_id', 'expiry'], ['token'=> $token]);

        return $resource;

    }

}