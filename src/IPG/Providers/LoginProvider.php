<?php
namespace IPG\Providers;
use IPG\Interfaces\LoginProviderInterface;
use Psr\Log\LoggerInterface;

// use IPG\Handlers\HttpMessageHandler;
use Psr\Http\Message\ServerRequestInterface;
use IPG\Handlers\CoreDBHandler;
use IPG\DAO\DBStoreFactory;
use IPG\Utility\Token;
use Ipg\Utility\Cookie;
use IPG\Config\Config;

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

class LoginProvider implements LoginProviderInterface{

  private $_handler;

  function __construct(){
    $this->_handler = new CoreDBHandler();
  }

  function login_page() {

    $html = file_get_contents(Config::getRootDirectory().'/src/templates/html/login_page.html');

    return new HtmlResponse($html);

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);

  }

  function login_handler(ServerRequestInterface $request){

    $params = $request->getParsedBody();

    $username = empty($params['name']) ? null : $params['name'];
    $email = empty($params['email']) ? null : $params['email'];
    $password = empty($params['pass']) ? null : $params['pass'];

    $isVerify = $this->_handler->checkLogin($username, $email, $password);

    if($isVerify == true) {

      //Stock token to cookie

      $token = Token::generate();

      Cookie::put(Config::getLoggedTokenName(), $token, Config::getLoggedTokenExpiry());

      //Stock user info to db

      $response = new HtmlResponse('Login successful.', 200);
    } else {
      $response = new HtmlResponse('<html><body><h2>Login failed, please try again.</h2></body></html>', 403);
    }

    return $response;

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);

    // echo "Login handler, Should redirect User to Login page.";
  }
  function login_verify(ServerRequestInterface $request){

    $params = $request->getParsedBody();

    $username = empty($params['name']) ? null : $params['name'];
    $email = empty($params['email']) ? null : $params['email'];
    $password = empty($params['pass']) ? null : $params['pass'];

    $isVerify = $this->_handler->checkLogin($username, $email, $password);

    if($isVerify == true) {
      $response = new HtmlResponse('Login successful.', 200);
    } else {
      $response = new HtmlResponse('<html><body><h2>Login failed, please try again.</h2></body></html>', 403);
    }

    return $response;

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);

    // echo "Login Verifier, the URL call back from login page for Token verification";
  }
  function login_success_handler($url){

    return $response = new RedirectResponse($url, 302);

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);

    // echo "Process to be run after success login, the response shall redirect back to service provider";
  }
  function login_fail_handler($url){

    return $response = new RedirectResponse($url, 302);

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);

    // echo "Process to be run after fail login, the response shall redirect back to service provider";
  }

}
