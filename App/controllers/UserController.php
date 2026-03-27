<?php 

namespace App\Controllers;
use Framework\Database;

class UserController{
    protected $db;

    public function __construct(){
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    public function login(){
        loadView("/user/login");
    }

    public function signup(){
        loadView("/user/signup");
    }
}

?>