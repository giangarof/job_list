<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use PDO;

class ListingsController{
    protected $db;

    public function __construct(){
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index(){

        $listings = $this->db->query("SELECT * FROM listings")->fetchAll();

        loadView('listings/index', ['listings' => $listings]);
    }

    public function listing_details($params){
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];

        $listing = $this->db->query("SELECT * FROM listings WHERE job_id = :id", $params)->fetch();

        if(!$listing){
            ErrorController::error404("This job does not exist.");
            return;
        }
        loadView('listings/listing_details', ['listing' => $listing]);

    }
    public function create(){
        loadView('listings/create');
    }
    
}

?>