<?php

	/**
	 * GET THE BASE PATH
	 * 
	 * @param string $path
	 * @return string
	 */
	function basePath($path = ''){
		return __DIR__ . '/' . $path;
	}

	/**
	 * LOAD A VIEW
	 * 
	 * @param string $name
	 * @return void
	 */
	function loadView($name){
		$view =  basePath("../views/{$name}.view.php");

		if(file_exists($view)){
			require $view;
		} else {
			echo "View '{$name}' not found!";
		};
	}

	/**
	 * LOAD A PARTIAL
	 * 
	 * @param string $name
	 * @return void
	 */
	function loadPartial($name){
		$partial = basePath("../views/partials/{$name}.php");

		if(file_exists($partial)){
			require $partial;
		} else {
			echo "View '{$name}' not found!";
		};
	}

?>