<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize{


	//handle user's request
	public function handle($role){
		if($role == 'guest' && $this-> isAuthenticated()){
			return redirect('/');
		}elseif($role == 'auth' && !$this-> isAuthenticated()){
			return redirect('/auth/login');
		}

	}

	//check if user is authenticated
	public function isAuthenticated(){
		return Session::has('user');

	}
}