<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use Framework\Session;
use App\Services\MailService;

class UserController{
    protected $db;

    public function __construct(){
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    public function requestForm(){
        loadView("/user/restore/requestPassword");
    }

    public function login(){
        loadView("/user/login");
    }

    public function signup(){
        loadView("/user/signup");
    }

    public function profile(){

        $user = Session::get('user');
        $query = "SELECT * FROM jobs WHERE user_id = {$user['user']->user_id} ORDER BY updated_at desc";
        $jobs = $this->db->query($query)->fetchAll();

        $query2 = "SELECT job.*, saved.* 
            FROM saved_jobs saved 
            JOIN jobs job
            ON saved.job_id = job.job_id
            WHERE saved.user_id = {$user['user']->user_id} 
            ORDER BY updated_at DESC";
        $saved =  $this->db->query($query2)->fetchAll();

        $query3 = "SELECT job.*, apply.* 
            FROM applied_jobs apply
            JOIN jobs job
            ON apply.job_id = job.job_id
            WHERE apply.user_id = :user_id 
            ORDER BY updated_at DESC";
        $applied =  $this->db->query($query3,[
            'user_id' => $user['user']->user_id
        ])->fetchAll();


        $applied_ids = array_column($applied,'job_id');



        // table
        $applicants = $this->db->query(
            "SELECT
                a.id,
                a.user_id,
                a.job_id,
                a.status,
                j.role,
                j.company_name,
                j.salary,
                u.name AS user_name
            FROM applied_jobs a
            JOIN jobs j ON a.job_id = j.job_id
            JOIN users u ON a.user_id = u.user_id
            WHERE j.user_id = :owner_id
            ORDER BY applied_at DESC",
            ['owner_id' => $user['user']->user_id]
        )->fetchAll();
        //  inspect_and_die($applicants);
        loadView("/user/profile", [
            'user'=> $user,
            'jobs'=> $jobs,
            'saved' => $saved,
            'applied' => $applied,
            'applied_ids' => $applied_ids,
            'applicants' => $applicants
        ]);
       
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

    // Request method, because youre requesting a token to restore your password
    // this fucntion generates the token to restore password
    public function requestToken(){

        $baseUrl = "http://" . $_SERVER['HTTP_HOST'];
        
        $email = $_POST['email'] ?? null;
        // inspect_and_die($email);


        // set errors
        $errors = [];

        if(!Validation::ValidateEmail($email)){
            $errors['email'] = "Please, enter a valid email.";
        }

        if(!empty($errors)){
            loadView('user/restore/requestPassword', [
                'errors'=>$errors,
            ]);
            exit;
        }


        // Steps to generate a token

        // 1 Check if user with this emails is in db
        $user = $this->db->query("
            SELECT * FROM users WHERE email = :email
        ", [
            'email' => $email
        ])->fetch();

        // inspect_and_die($user);

        if(!$user){
            return forgetSuccess();
        }
        
        // 2 Generate the token
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);

        // 3 store the token in db
        $this->db->query("
            INSERT INTO password_reset (user_id, tokenHashed, expires_at)
            VALUES (:user_id, :token, :expires_at)
        ", [
            'user_id' => $user->user_id,
            'token' => $tokenHash,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ]);

        // 4. Send email (pseudo - adapt to your system)
        $resetLink = $baseUrl . "/reset-password?token=" . $token;
        // inspect_and_die($resetLink);
        $mail = MailService::sendEmail($email, "reset Password", $resetLink);
        // sendMail(
        //     $email,
        //     "Password Reset",
        //     "Click here to reset your password: " . $resetLink,
        // );

        // 5. Always respond same way
        return forgetSuccess();

    }

    public function showResetForm(){
        $token = $_GET['token'] ?? null;

        if (!$token) {
            ErrorController::error400("Invalid token.");
            return;
        }

        // hash token to compare with DB
        $tokenHash = hash('sha256', $token);

        // find both hashed tokens
        $reset = $this->db->query("
            SELECT *
            FROM password_reset
            WHERE tokenHashed = :token
            AND expires_at > NOW()
        ", [
            'token' => $tokenHash
        ])->fetch();

        if (!$reset) {
            ErrorController::error403("Token invalid or expired.");
            return;
        }
        return loadView("/user/restore/newPassword", [
            'token' => $token
        ]);

        
    }

    public function restorePasswordAction(){

        $token = $_POST['token'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirm = $_POST['confirm_password'] ?? null;

        // check for errors
        $errors=[];

        if(!$token){
            redirect('/');
        }

        if(!$password || !$confirm){
            $errors['password'] = "Missing fields. Try again.";
        }

        if(!Validation::matchValue($password, $confirm)){
            $errors['passwordConfirmation'] = "Password and password confirmation should match. Try again.";
        }

        if(!empty($errors)){
            loadView('user/restore/newPassword', [
                'errors'=>$errors,
                
            ]);
            exit;
        }

        // hash token
        $tokenHash = hash('sha256', $token);

        // find (token) reset request
        $reset = $this->db->query("
            SELECT *
            FROM password_reset
            WHERE tokenHashed = :token
            AND expires_at > NOW()
        ", [
            'token' => $tokenHash
        ])->fetch();

        if (!$reset) {
            return ErrorController::error403("Invalid or expired token.");
        }

        // hash the new password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // update user password
        $this->db->query("
            UPDATE users
            SET password = :password
            WHERE user_id = :user_id
        ", [
            'password' => $passwordHash,
            'user_id' => $reset->user_id
        ]);

        // delete reset token (important)
        $this->db->query("
            DELETE FROM password_reset
            WHERE user_id = :user_id
        ", [
            'user_id' => $reset->user_id
        ]);

        alert('success', 'Password updated. Please, Login.');
        redirect('/user/login');


        
    }

}

?>