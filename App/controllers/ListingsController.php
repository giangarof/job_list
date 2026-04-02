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

    // store data in DB
    public function store(){

        $allowedFields=[
            "role",
            "salary",
            "requirements",
            "description",
            "remote",
            "company_name",
            "job_location",
            "company_about",
            "benefits",
        ];
            
        $benefitsAllowed = [
            "401k",
            "vacations",
            "parental_leave",
            "pto",
            "employee_discount",
            "relocation"
        ];
            
        $new_listing_data = array_intersect_key($_POST, array_flip($allowedFields));
        $benefits = $_POST['benefits'] ?? [];
        $benefits = array_intersect($benefits ?? $benefitsAllowed);
                
        $new_listing_data['benefits'] = implode(', ', $benefits);
                
        $new_listing_data['user_id'] = 1;
        $new_listing_data=array_map('sanitizeData', $new_listing_data);
                
        $requiredFields = ["role",
            "salary",
            "requirements",
            "description"];
                
            $errors =[];
            foreach($requiredFields as $field){
                if (empty($new_listing_data[$field]) || !Validation::validateString($new_listing_data[$field])){
                    $errors[$field] = ucfirst($field) . " is required";
                    };
                        
                };
                if(!empty($errors)){
                //reload
                    loadView('listings/create', ['errors' => $errors, 'listing' => $new_listing_data]);
                }else{
                                
                    $fields = [];
                    foreach($new_listing_data as $field => $value){
                        $fields[] = $field;
                    };
                    $fields = implode(',', $fields);
                                    
                    $values = [];
                    foreach($new_listing_data as $field => $value){
                    if($value === ''){
                        $new_listing_data[$field] = null;
                    }
                    $values[] = ':' . $field;
                                            
                };
                $values = implode(',', $values);
                                            
                $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";
                           
                $this->db->query($query, $new_listing_data);
                redirect('/');
                }
                                            
            }
        }
?>
                             