<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use PDO;

class HomeController{
    protected $db;
    public function __construct(){
        // die('HomeController');
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index(){
        $jobs = $this->db->query("SELECT * FROM jobs order by updated_at desc LIMIT 6")->fetchAll();
        // inspect($jobs);

        loadView('home', ['jobs' => $jobs]);
    }

}




?>