<?php

namespace IPG\Handlers;

use Psr\Http\Message;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

class HttpMessageHandler {
    
    public function __construct() {

        

    }

    public function emit($params) {

        $response = new HtmlResponse($params);

        $this->_emitter = new SapiEmitter();
        $this->_emitter->emit($response);

    }

}