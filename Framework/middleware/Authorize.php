<?php 

namespace Framework\Middleware;

use Framework\Session;

class Authorize{

    public function is_authenticated(){
        return Session::has('user');
    }

    // handle the user req
    public function handle($role){
        if($role === 'guest' && $this->is_authenticated()){
            return redirect('/');
        } elseif($role === 'auth' && !$this->is_authenticated()){
            alert('danger', 'Please, login ...');
            return redirect('/user/login');
        }
    }
}

?>