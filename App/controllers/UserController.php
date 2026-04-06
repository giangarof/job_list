<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;

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
    public function profile(){
        loadView("/user/profile");
    }

    public function store(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['passwordConfirmation'];
        $agreement = isset($_POST['agreement']);

        $errors=[];

        if(!Validation::validateString($name,2,50)){
            $errors['name'] = "Please, name muste be between 2 and 50 characters.";
        }

        if(!Validation::ValidateEmail($email)){
            $errors['email'] = "Please, enter a valid email.";
        }
        if(!Validation::validateString($password,2,50)){
            $errors['password'] = "Please, password muste be between 2 and 50 characters.";
        }

        if(!Validation::matchValue($password, $passwordConfirmation)){
            $errors['passwordConfirmation'] = "Password and password confirmation should match. Try again.";
        }

        if(!$agreement){
            $errors['agreement'] = "You need to agree our terms and conditions to join.";
        }
        
        
        if(!empty($errors)){
            loadView('user/signup', [
                'errors'=>$errors,
                'user'=>[
                    'name'=>$name
                ]
            ]);
            exit;
        }


        


    }
}

?>