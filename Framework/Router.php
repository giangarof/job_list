<?php
namespace Framework;
use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;
// $routes = require getBasePath('routes.php');

class Router{
    protected $routes = [];


    // Defining route methods

    public function registerRoute($method, $uri, $action, $middleware=[]){
        list($controller, $controllerMethod) = explode('@', $action);
        // inspect($controller, $controllerMethod);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware'=> $middleware
        ];
    }
 
    public function get($uri, $controller, $middleware=[]){
        $this->registerRoute('GET', $uri, $controller, $middleware);

    }
 
    public function post($uri, $controller, $middleware=[]){
        $this->registerRoute('POST', $uri, $controller, $middleware);
    }
 
    public function put($uri, $controller, $middleware=[]){
        $this->registerRoute('PUT', $uri, $controller, $middleware);
    }
 
    public function delete($uri, $controller, $middleware=[]){
        $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }


    // Define route request

    public function route($uri){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        // inspect_and_die($requestMethod);

        // check for _method input
        if($requestMethod === 'POST' && isset($_POST['_method'])){
            // override
            $requestMethod = strtoupper($_POST['_method']);
        }
        // inspect_and_die($requestMethod);

        foreach($this->routes as $route){

            $uriSegment = explode('/', trim($uri, '/'));
            $routeSegment = explode('/', trim($route['uri'], '/'));
            $match = true;

            if(count($uriSegment) === count($routeSegment) && strtoupper($route['method']) === $requestMethod){
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
                    foreach($route['middleware'] as $middleware){
                        (new Authorize())->handle($middleware);
                    }
                    $controller = 'App\\controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

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