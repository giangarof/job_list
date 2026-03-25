<?php

// $routes = require getBasePath('routes.php');

class Router{
    protected $routes = [];


    // Defining route methods

    public function registerRoute($method, $uri, $controller){
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
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


    // Define the request

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === $method){
                require getBasePath($route['controller']);
                return;
            }
        }
        http_response_code(404);
        loadView('error/404');
        exit;
    }

}


?>