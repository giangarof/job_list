<?php

class Router {
	protected $routes = [];

	public function registerRoute($method, $uri, $controller){
		$this->routes[] = [
			'method' => $method,
			'uri' => $uri,
			'controller' => $controller
		];
	}

	// LOAD ERROR PAGE
	// PARAM INIT $HTTPCODE
	// RETURN VOID
	public function error($httpCode = 404){
		http_response_code($httpCode);
		loadView("error/{$httpCode}");
		exit;
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
				require basePath('../' . $route['controller']);
				return;
			}
		};

		$this->error(404);
	}

}
	


























