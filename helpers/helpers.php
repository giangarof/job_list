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
	function loadView($name, $data = []){
		$view =  basePath("../App/views/{$name}.view.php");

		// inspect($view);

		if(file_exists($view)){
			extract($data);
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
	function loadPartial($name, $data = []){
		$partial = basePath("../App/views/partials/{$name}.php");

		if(file_exists($partial)){
			extract($data);
			require $partial;
		} else {
			echo "View '{$name}' not found!";
		};
	}

	/**
	 * INSPECT A VALUE
	 * 
	 * @param mixed $value
	 * @return void
	 * 
	 */
	function inspect($value){
		echo '<pre>';
		var_dump($value);
		echo '</pre';
	}

	/**
	 * INSPECT A VALUE AND DIE
	 * 
	 * @param mixed $value
	 * @return void
	 * 
	 */
	function inspect_and_die($value){
		echo '<pre>';
		var_dump($value);
		echo '</pre';
		die();
	}

	// Format Salary
	// @param string salary
	// @return string formatted salary

	function formatSalary($salary){
		return '$' . number_format(floatval($salary));
	}

	// sanitize data
	// @param string $data
	// return string
	function sanitize($data){
		return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
	}

	// redirect to a given url
	// @param string url
	// return void
	function redirect($url){
		header("Location: {$url}");
		exit();
	}


?>







