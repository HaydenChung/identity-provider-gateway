<?php
namespace IPG;
use IPG\HttpMessageHandler;

use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

use IPG\Config\Config;


class ExampleApp{

  public function __construct(){

    $routeData = require_once(__DIR__.'\..\..\config\routes.php');
    $configData = require_once(__DIR__.'\..\..\config\config.php');

    $r = new HttpMessageHandler($routeData);
    $c = Config::init($configData);

    $this->app = IPGFactory::create($r, $c);
    
  }


  public function run(){

    $log = new \Psr\Log\NullLogger();
    $response = $this->app->run();

    $this->_emitter = new SapiEmitter();
    $this->_emitter->emit($response);

  }
}
