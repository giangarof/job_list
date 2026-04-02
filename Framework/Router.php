<?php
namespace Framework;
use App\Controllers\ErrorController;
// $routes = require getBasePath('routes.php');

class Router{
    protected $routes = [];


    // Defining route methods

    public function registerRoute($method, $uri, $action){
        list($controller, $controllerMethod) = explode('@', $action);
        // inspect_and_die($controller, $controllerMethod);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }
 
    public function get($uri, $controller){
        $this->registerRoute('GET', $uri, $controller);

    }
 
    public function post($uri, $controller){
        $this->registerRoute('POST', $uri, $controller);
    }
 
    public function put($uri, $controller){
        $this->registerRoute('PUT', $uri, $controller);
    }
 
    public function delete($uri, $controller){
        $this->registerRoute("DELETE", $uri, $controller);
    }


    // Define route request

    public function route($uri){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        foreach($this->routes as $route){

            $uriSegment = explode('/', trim($uri, '/'));
            $routeSegment = explode('/', trim($route['uri'], '/'));
            $match = true;

            if(count($uriSegment) === count($routeSegment) && strtoupper($route['method'] === $requestMethod)){
                $params = [];
                $match =true;
                for($i = 0; $i < count($uriSegment); $i++){
                    if($routeSegment[$i] !== $uriSegment[$i] && !preg_match('/\{(.+?)\}/', $routeSegment[$i])){
                        $match = false;
                        break;
                    }

                    if(preg_match('/\{(.+?)\}/', $routeSegment[$i], $matches)){
                        $params[$matches[1]] = $uriSegment[$i];
                        
                    }
                }
                if($match){
                    $controller = 'App\\controllers\\' . $route['controller'];
                    $controllerMethod= $route['controllerMethod'];

                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }

            }


            


        }
        ErrorController::error404();

    }

}


?>