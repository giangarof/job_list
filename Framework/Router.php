<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router {
	protected $routes = [];

	public function registerRoute($method, $uri, $action){
		list($controller, $controllerMethod) = explode('@', $action);
		// inspect($controllerMethod);
		$this->routes[] = [
			'method' => $method,
			'uri' => $uri,
			'controller' => $controller,
			'controllerMethod' => $controllerMethod
		];
	}

	// ADD GET ROUTE
	// @ PARARM STRING $URI
	// @ PARARM STRING $CONTROLLER
	// RETURN VOID
	public function get($uri, $controller){
		$this->registerRoute('GET', $uri, $controller);
	}

	// ADD POST ROUTE
	// @ PARARM STRING $URI
	// @ PARARM STRING $CONTROLLER
	// RETURN VOID
	public function post($uri, $controller){
		$this->registerRoute('POST', $uri, $controller);
	}

	// ADD PUT ROUTE
	// @ PARARM STRING $URI
	// @ PARARM STRING $CONTROLLER
	// RETURN VOID
	public function put($uri, $controller){
		$this->registerRoute('PUT', $uri, $controller);
	}

	// ADD delete ROUTE
	// @ PARARM STRING $URI
	// @ PARARM STRING $CONTROLLER
	// RETURN VOID
	public function delete($uri, $controller){
		$this->registerRoute('DELETE', $uri, $controller);
	}


	// ROUTE THE REQUEST
	// @ PARAM STRING $URI
	// @ PARAM STRING $METHOD
	// RETURN VOID
	public function route($uri){
		$requestMethod = $_SERVER['REQUEST_METHOD'];

		// check for _method input
		if($requestMethod === 'POST' && isset($_POST['_method'])){
			$requestMethod = strtoupper($_POST['_method']);
		}

		foreach($this->routes as $route){
			$uriSegments = explode('/', trim($uri, '/'));
			$routeSegments = explode('/', trim($route['uri'], '/'));
			$match = true;

			if(count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)){
				$params = [];
				$match = true;
				
				for($i = 0; $i < count($uriSegments); $i++){
					//if the uri do not match and there is no param
					if($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])){
						$match = false;
						break;
					};

					// check for the param and add to $params array
					if(preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)){
						$params[$matches[1]] = $uriSegments[$i];
					};
				}

				if($match){
						$controller = 'App\\Controllers\\' . $route['controller'];
						$controllerMethod = $route['controllerMethod'];

						//instantiate the controller and call the method 
						$controllerInstance = new $controller();
						$controllerInstance->$controllerMethod($params);

						return;

				}
			}
		};

		ErrorController::notFound();
	}

}
	


























