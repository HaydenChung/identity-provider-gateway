<?php
namespace IPG\Providers;
use Psr\Log\LoggerInterface;
use IPG\Handlers\HttpMessageHandler;
use IPG\Handlers\CoreDBHandler;
use IPG\Handlers\CoreDrupalApiHandler;
use IPG\Interfaces\CoreServiceProviderInterface;
use IPG\Handlers\IdentityDBHandler;

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

class CoreServiceProvider implements CoreServiceProviderInterface{

  private $_coreDBHandler, $_identityDBHandler;

  function __construct(){

    $this->_coreDBHandler = new CoreDBhandler();

    $this->_identityDBHandler = new IdentityDBHandler();

  }

  /**
   * Get user info, emit a response
   */
  function get_identity_info($token, $request){

    $userInfo = $this->_identityDBHandler->getUserInfo($token);
    
    return new JsonResponse(json_encode($userInfo), 200);

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);
    
    // echo "<BR><BR>Get User Identity call (IPG get from Core Service)";
  }
  function get_resource_info($token, $request){

    $userResource = $this->_identityDBHandler->getUserResource($token);

    return new JsonResponse(json_encode($userResource));

    // $this->_emitter = new SapiEmittger();
    // $this->_emitter->emit($response);

    // echo "Get Resource Info (Share Menu) from Core service provider";
  }

  function forget_password($request){

    // $username = empty($params['name']) ? null : $params['name'];
    // $email = empty($params['email']) ? null : $params['email'];
    // $password = empty($params['pass']) ? null : $params['pass'];



    return new JsonResponse(['on dev']);

    // $this->_emitter = new SapiEmitter();
    // $this->_emitter->emit($response);

  }
}
