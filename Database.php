<?php

class Database {
	public $conn;

	//constructor for database class
	//@param array $config
	public function __construct($config){
		$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

		$opstions = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try{
			$this->conn = new PDO($dsn, $config['username'], $config['password']);
		
		}catch (PDOException $e){
			throw new Exception("Database conection failed {$e->getMessage()}");
		};
	}
};