<?php

namespace IPG\Utility;

use IPG\Utility\Session;
use IPG\Config\Config;

class Token {
	// /**
	//  * Gen and store token to session with given stock name.
	//  * @param	string	$stockToken	Session key to be store.s
	//  * 
	//  * @return	string
	//  */
	// public static function generateToSession(string $stockToken=null){
	// 	$tokenPath = is_null($stockToken) ? Config::getSessionName() : $stockToken ;
    //     if (function_exists('mcrypt_create_iv')) {
    //         $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	//     } else {
	//         $token = bin2hex(openssl_random_pseudo_bytes(32));
	//     }
	//     Session::put($tokenPath,$token);
	//     return Session::get($tokenPath);
	// }
	public static function check($inputToken,$stockToken=null){
		$tokenPath = is_null($stockToken) ? Config::getSessionName() : $stockToken;
		if(hash_equals($inputToken,Session::get($tokenPath))){
			Session::delete($tokenPath);
			return true;
		}
		return false;
	}

	public static function generate() {
		if (function_exists('mcrypt_create_iv')) {
            $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	    } else {
	        $token = bin2hex(openssl_random_pseudo_bytes(32));
		}
		return $token;
	}
}
