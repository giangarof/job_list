<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController {
	protected $db;

	public function __construct(){
		$config = require basePath('../' . 'config/db.php');
		$this->db = new Database($config);
	}


	//display login page
	public function login(){
		loadView('users/login');
	}

	//display register page
	public function register(){
		loadView('users/register');
	}

	// store submision in DB
	public function store(){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['passwordConfirmation'];

		$errors = [];

		if(!Validation::email($email)){
			$errors['email'] = "Please enter a valid email";
		}

		if(!Validation::string($name, 2, 50)){
			$errors['name'] = "Name must be between 2-50 characters.";
		}

		if(!Validation::string($password, 6, 50)){
			$errors['password'] = "Password must be between 6-50 characters.";
		}

		if(!Validation::match($password, $confirmPassword)){
			$errors['passwordConfirmation'] = "Passwords must match.";
		}

		if(!empty($errors)){
			loadView('users/register', [
				'errors' => $errors,
				'user' => [
					'name' => $name,
					'email' => $email,
					'city' => $city,
					'state' => $state,

				]
			]);
			exit;
		} 
		//check if email exists
		$params = [
			'email' => $email
		];

		$user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();
		if($user){
			$errors['email'] = 'The email you provided is already registered.';
			loadView('users/register', [
				'errors' => $errors
			]);
			exit;
		}

		//crate account
		$params = [
			'name' => $name,
			'email' => $email,
			'city' => $city,
			'state' => $state,
			'password' => password_hash($password, PASSWORD_DEFAULT)
		];

		$this->db->query("INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)", $params);

		//get new userID
		$userID = $this->db->conn->lastInsertId();
		Session::set('user', [
			'id' => $userID,
			'name' => $name,
			'email' => $email,
			'city' => $city,
			'state' => $state
		]);

		// inspect_and_die(Session::get('user'));


		redirect('/');
	}

	//logout
	public function logout(){
		Session::clearAll();
		$params = session_get_cookie_params();
		setcookie('PHPSESSID', '', time() - 42000, $params['path'], $params['domain']);
		redirect('/');
	}

	//authenticat user with password
	public function signin(){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$errors = [];

		if(!Validation::email($email)){
			$errors['email'] = 'Please enter a valid email';

		}

		if(!Validation::string($password, 6, 50)){
			$errors['password'] = 'Password must be at least 6 characters';

		}

		if(!empty($errors)){
			loadView('users/login',[
				'errors' => $errors
			]);
		}

		//check if email exists
		$params = [
			'email' => $email
		];

		$user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

		if(!$user){
			$errors['email'] = 'Incorrect credentials.';
			loadView('users/login',[
				'errors' => $errors
			]);
			exit;
		}

		//check if password is correct
		if(!password_verify($password, $user->password)){
			$errors['email'] = 'Incorrect credentials.';
			loadView('users/login',[
				'errors' => $errors
			]);
			exit;
		}


		//set session
		Session::set('user', [
			'id' => $user->id,
			'name' => $user->name,
			'email' => $user->email,
			'city' => $user->city,
			'state' => $user->state
		]);
		redirect('/');

	}


}








































