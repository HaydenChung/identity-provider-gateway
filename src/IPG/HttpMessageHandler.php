<?php

namespace IPG;

use FastRoute\Route;
use Psr\Log\LoggerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use IPG\IdentityProviderGateway;
use IPG\Handlers\RouteHandler;
use IPG\Config\Config;
use IPG\Exceptions\RouteHandleException;
use IPG\Handlers\HttpRequestHandler;

use Zend\Diactoros\Response\HtmlResponse;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

/**
* Handle routes for IPG.
*/
class HttpMessageHandler {

    private $_routeHandler,
    $_request,
    $_ipg,
    $_allowMethods,
    $_patternRegex,
    $_routeConfig;

    public function __construct(array $routeConfig) {

        $this->_routeConfig = $routeConfig;

    }



    public function setIPG(IdentityProviderGateway $ipg) {

        $this->_ipg =  $ipg;
        $this->_allowMethods = Config::getRouteMethods();
        $this->_patternRegex = Config::getRoutePattern();
        $this->_init();

    }

    private function _init() {

        try{

            $this->_request = HttpRequestHandler::fromGlobals();

            $this->_routeHandler = new RouteHandler(
                $this->_routeConfig,
                Config::isCaching(),
                Config::cacheFilePath(),
                $this->_request
            );
            
        }catch(RouteHandleException $error) {
            
            $response = new HtmlResponse("<h2>".$error->getMessage()."</h2>", $error->getCode());

            $this->_emitter = new SapiEmitter();
            $this->_emitter->emit($response);
        }

    }

    private function _verify_incoming_request(ServerRequestInterface $request){
        // method and routePattern is a must.
        $method = $request->getMethod();
        $path = $request->getUri()->getPath();

        //TODO: Verify Method
        if(!in_array($request->getMethod(), $this->_allowMethods)) throw new RouteHandleException('Method Not Allowed:'.$method, 405);
            
        //TODO:: Verify path pattern
        if($this->_patternRegex != null) {
            if(!preg_match($this->_patternRegex, $path)) throw new RouteHandleException('Path unexperted'. $path, 404);
        }

        return true;
    }

    public function handle() {

        try{

            $this->_verify_incoming_request($this->_request);
    
            return $this->_routeHandler->dispatch();

        }catch(RouteHandleException $error) {
            
            return $response = new HtmlResponse("<h2>".$error->getMessage()."</h2>", $error->getCode());

            // $this->_emitter = new SapiEmitter();
            // $this->_emitter->emit($response);
        }

    }

}