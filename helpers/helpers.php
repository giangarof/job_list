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
	function loadPartial($name){
		$partial = basePath("../App/views/partials/{$name}.php");

		if(file_exists($partial)){
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


?>







