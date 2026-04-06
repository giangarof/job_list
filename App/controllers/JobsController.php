<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use PDO;

class JobsController{
    protected $db;

    public function __construct(){
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    // Fetch all jobs
    public function index(){
        $jobs = $this->db->query("SELECT * FROM listings order by job_id desc")->fetchAll();

        loadView('jobs/index', ['jobs' => $jobs]);
    }

    // Fetch Job details
    public function job_details($params){
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];

        $job = $this->db->query("SELECT * FROM listings WHERE job_id = :id", $params)->fetch();

        if(!$job){
            ErrorController::error404("This job does not exist.");
            return;
        }
        loadView('jobs/job_details', ['job' => $job]);

    }

    // Display create job form
    public function create(){
        loadView('jobs/create');
    }

    // Delete Job
    public function deleteJob($params){
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];
        $job = $this->db->query("SELECT * FROM listings WHERE job_id = :id", $params)->fetch();
        if(!$job){
            ErrorController::error404("Job doesn't exist ... ");
            return;
        }
        $this->db->query("Delete FROM listings WHERE job_id = :id", $params);

        alert('success', "Job has been deleted Successfully");
        redirect('/');
    }

    // Store Job in DB
    public function store(){

        $allowedFields=[
            "role",
            "salary",
            "requirements",
            "description",
            "modality",
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
                
        $new_listing_data['benefits'] = implode(',', $benefits);
                
        $new_listing_data['user_id'] = 1;
        $new_listing_data=array_map('sanitizeData', $new_listing_data);
                
        $requiredFields = ["role",
            "salary",
            "requirements",
            "description", "benefits"];
                
        $errors =[];
        foreach($requiredFields as $field){
            if (empty($new_listing_data[$field]) || !Validation::validateString($new_listing_data[$field])){
                $errors[$field] = ucfirst($field) . " is required";
                };
                        
            };
            if(!empty($errors)){
            //reload
                loadView('jobs/create', ['errors' => $errors, 'job' => $new_listing_data]);
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
                
            alert('success', "Job has been created Successfully");
               
            redirect('/');

        }
                                            
    }

    // Display update job form    
    public function updateJobForm($params){
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];
        $job = $this->db->query("SELECT * FROM listings WHERE job_id = :id", $params)->fetch();
        $benefits = explode(',', $job->benefits ?? "");
        // inspect_and_die($job);
        if(!$job){
            ErrorController::error404("This job does not exist.");
            return;
        }
        loadview('jobs/update_job', ['job' => $job, 'benefits'=>$benefits]);
    }


    // Update job
    public function updateJob($params){

        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];
        $job = $this->db->query("SELECT * FROM listings WHERE job_id = :id", $params)->fetch();
        $benefits = explode(',', $job->benefits ?? "");
        // inspect_and_die($job);
        if(!$job){
            ErrorController::error404("This job does not exist.");
            return;
        }
        $_POST['remote'] = isset($_POST['remote']) ? 'Yes' : 'No';

        $allowedFields=[
                "role",
                "salary",
                "requirements",
                "description",
                "modality",
                "company_name",
                "job_location",
                "company_about",
                "benefits",
        ];
                
        $benefitsAllowed = [
                "401k",
                "vacations",
                "parental leave",
                "pto",
                "employee discount",
                "relocation"
        ];

        $updatedValues = [];

        $updatedValues= array_intersect_key($_POST, array_flip($allowedFields));

        $benefits = $_POST['benefits'] ?? [];
        $benefits = array_intersect($benefits, $benefitsAllowed);
        $updatedValues['benefits'] = implode(',', $benefits);
        $updatedValues=array_map('sanitizeData', $updatedValues);
        $requiredFields = ["role",
            "salary",
            "requirements",
            "description"];

        $errors = [];

        foreach($requiredFields as $field){
            if (empty($updatedValues[$field]) || !Validation::validateString($updatedValues[$field])){
                $errors[$field] = ucfirst($field) . " cannot be left blank.";
                };
                        
            };
            if(!empty($errors)){
            //reload
                loadView('jobs/update_job', ['errors' => $errors, 'job' => $job, 'benefits' => $benefits]);
                exit;
            }else{
                
                $updateFields = [];
                foreach(array_keys($updatedValues) as $field){
                    $updateFields[] = "{$field} = :{$field}";
                }
                $updateFields = implode(',', $updateFields);
                $query = "UPDATE listings SET $updateFields WHERE job_id = :id";
                $updatedValues['id'] = $id;                
                // inspect_and_die($updatedValues);
                $this->db->query($query, $updatedValues);
                alert('success', "Job has been updated successfully!");
                   
                redirect('/job/job_details/'. $id);
            };

                           
                
        
            
    }
}

?>
                             