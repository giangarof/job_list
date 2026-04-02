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
        $listings = $this->db->query("SELECT * FROM listings LIMIT 6")->fetchAll();
        // inspect($listings);

        loadView('home', ['listings' => $listings]);
    }

}




?>