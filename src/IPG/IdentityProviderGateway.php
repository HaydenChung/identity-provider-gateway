<?php

namespace IPG;
use Psr\Http\Message\ResponseInterface;
use IPG\HttpMessageHandler;



  class IdentityProviderGateway{
  private $_loginProvider;                                  // The Login Service provider
  private $_coreServiceProvider;                            // The Core Service Provider
  private $_serviceProviderRegistrationHandler;             // Handle Service Provider Registeration (pass site info to core)
  private $_route;
  // private $_globalResourceInterface;                        // Handle share resource between providers (final decision on Service Provider how to use the resource.)
  // private $_accountHandlingInterface;                       // Create / Forget Password.

  // Put it in a function for easy reading, its just a Parameter Init.
  public function hello_world(){
    echo "hello world";
  }


  public function __construct(
    HttpMessageHandler $route
  ){
    $this->_route = $route;
    $this->_route->setIPG($this);
    // $this->_globalResourceInterface = $globalResourceInterface;, By coreServicePrvider
    // $this->_accountHandlingInterface = $accountHandlingInterface;;, By coreServicePrvider
  }

  public function run(): ResponseInterface{
    return $this->_route->handle();
    //
  }
}
