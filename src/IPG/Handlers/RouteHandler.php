<?php

namespace Ipg\Handlers;

use Exception;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\cachedDispatcher;
use function FastRoute\simpleDispatcher;

use Psr\Http\Message\ServerRequestInterface;

use IPG\Exceptions\RouteHandleException;
use IPG\Interfaces\BaseProviderInterface;

class RouteHandler {

    private $_dispatcher, $_config, $_routes, $_request;

    public function __construct(array $routes, bool $isCaching, string $cacheFilePath, ServerRequestInterface $request) {

        $this->_routes = $routes;

        $this->_request = $request;

        $this->_init($isCaching, $cacheFilePath);

    }

    private function _init(bool $isCaching, string $cacheFilePath) {

        // $this->_config = Config::getInstance();
        
        if($isCaching == true) {
            $this->_dispatcher = cachedDispatcher(function(RouteCollector $r) {
                $this->_addRoutes($r);
            },[
                'cacheFile'=> $cacheFilePath
            ]);
        }else{
            $this->_dispatcher = simpleDispatcher(function(RouteCollector $r) {
                $this->_addRoutes($r);
            });
        }

    }

    public function dispatch() {

        $method = $this->_request->getMethod();

        $uriString = $this->_request->getUri()->getPath();

        $routeInfo = $this->_dispatcher->dispatch($method, $uriString);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:

                throw new RouteHandleException('Route not found.', 404);

                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];

                throw new RouteHandleException('Method not allowed:'.$method, 405);
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                // if($method == 'POST') {
                //     // $postData = $_POST;
                //     $vars = array_merge($routeInfo[2], $res);
                // }

                return $this->_routeHandler($handler, $this->_request, $vars);

                // var_dump($handler);
                // ... call $handler with $vars
                break;
        }

    }

    private function _addRoutes(RouteCollector $r) {

        foreach($this->_routes as $route) {
            $r->addRoute($route['method'], $route['routePattern'], $route['handler']);
        }

    }

    private function _routeHandler(string $stringifyHandler, ServerRequestInterface $request, $params = []) {

        try{

            list($className, $methodName) = explode('::', $stringifyHandler);

            $class = new $className();

            if(!method_exists($class, $methodName)) throw new Exception('Failed to parse route handler:'.$stringifyHandler);

        }catch(Exception $e) {
            throw new Exception('Failed to parse route handler:'.$stringifyHandler);
        }

        if(!$class instanceof BaseProviderInterface) throw new Exception("Expecting class implements BaseProviderInterface in route's handler, {$className} given");

        $params[] = empty($params) ? $request : $request;

        return call_user_func_array(array($class, $methodName), $params);

    }

    private function _classRegex($namespace) {
        // Check class namespace pattern, only provider should allow
        $regex = '([\w_]+\\[\w_]+\\Providers\\[\w_]+)::([\w_]+)';

        $matches = [];

        preg_match($regex, $namespace, $matches);

        return $matches;
    }

}