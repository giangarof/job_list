<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use Framework\Session;

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
                    'name'=>$name,
                    'email'=>$email
                ]
            ]);
            exit;
        }

        // check if email is in DB
        $params = [
            'email'=> $email
        ];

        $user = $this->db->query('Select * from users where email = :email', $params)->fetch();

        if($user){
            $errors['email'] = 'Email already registered, please use another one.';
            loadView('user/signup', [
                'errors'=>$errors,
                
            ]);
            exit;
        }


        // create account
        $params = [
            'name'=>$name,
            'email'=>$email,
            'password'=> password_hash($password, PASSWORD_DEFAULT),
            'agreement'=>$agreement
        ];
        

        $this->db->query('INSERT INTO users (name, email, password, agreement) VALUES (:name, :email, :password, :agreement)', $params);

        alert('success', 'User created successfully. Please, Login.');
        redirect('/user/login');

    }

    public function authenticate(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors=[];
        
        $params = [
            'email'=> $email
        ];
        $user = $this->db->query('Select * from users where email = :email', $params)->fetch();
        
        if(!Validation::ValidateEmail($email)){
            $errors['email'] = "Please, enter a valid email.";
        }

        if(!$user || !Validation::verifyPassword($password, $user->password)){
            $errors['auth'] = "Incorrect credentials. Try again.";
        }

        if(!empty($errors)){
            loadView('user/login', [
                'errors'=>$errors,
                'user'=>[
                    'email'=>$email,
                ]
            ]);
            exit;
        }
        unset($user->password);
        Session::set('user', [
            'user'=>$user
        ]);

        // inspect_and_die(Session::get('user'));
        redirect('/user/profile');
        
    }


    public function logout(){
        // alert('success', "You've been logged out successfully.");
        Session::clearAll();
        
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 86400, $params['path'], $params['domain']);
        redirect('/user/login');
        
    }
}

?>