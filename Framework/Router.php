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
	public function route($uri, $method){
		foreach($this->routes as $route){
			if($route['uri'] === $uri && $route['method'] === $method){
				// require basePath('../App/' . $route['controller']);
				// extrac controller and controller method
				$controller = 'App\\Controllers\\' . $route['controller'];
				$controllerMethod = $route['controllerMethod'];

				//instantiate the controller and call the method 
				$controllerInstance = new $controller();
				$controllerInstance->$controllerMethod();

				return;
			}
		};

		ErrorController::notFound();
	}

}
	


























