<?php

namespace Framework;

class Session{

	//start session
	public static function start(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	//set session key/value pair
	public static function set($key, $value){
		$_SESSION[$key] = $value;

	}

	//get session by the key
	public static function get($key, $default = null){
		return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
	}

	//check is session key exists
	public static function has($key){
		return isset($_SESSION[$key]);
	}

	//clear session by key
	public static function clear($key){
		if(isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}

	//clear all session data
	public static function clearAll(){
		session_unset();
		session_destroy();
	}
}