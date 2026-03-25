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


    // Define error method
    // Default is 404

    public function error($httpCode = 404){
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }


    // Define route request

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === $method){
                require getBasePath($route['controller']);
                return;
            }
        }
        $this->error();

    }

}


?>