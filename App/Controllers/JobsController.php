<?php 

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use Framework\Session;
use PDO;

class JobsController{
    protected $db;

    public function __construct(){
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    // Fetch all jobs
    public function index(){
        $userId = Session::get('user')['user']->user_id ?? null;
        $jobs = $this->db->query("SELECT * FROM jobs order by updated_at desc")->fetchAll();

        $exists= $this->db->query("SELECT * 
            FROM saved_jobs 
            WHERE user_id = :userId",[
                'userId'=> $userId,
            ])->fetchAll();
        $saved_ids = array_column($exists, 'job_id');

        // check if user applied 
        $applied = $this->db->query("SELECT * 
            FROM applied_jobs
            WHERE user_id = :userId", [
                 'userId'=> $userId,
                //  'jobId' => $jobs['job_id']
            ])->fetchAll();
        $applied_ids = array_column($applied, 'job_id');

        // inspect_and_die($saved_ids);

        loadView('jobs/index', ['jobs' => $jobs, 'saved_ids' => $saved_ids, 'applied_ids' => $applied_ids]);
    }

    // Fetch Job details
    public function job_details($params){
        $userId = Session::get('user')['user']->user_id ?? null;
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];

        $job = $this->db->query("SELECT * FROM jobs WHERE job_id = :id", $params)->fetch();

        if(!$job){
            ErrorController::error404("This job does not exist... Try with other ID");
            return;
        }

        // check if user applied
        $exists = $this->db->query("SELECT * 
            FROM applied_jobs 
            WHERE user_id = :userId 
            AND job_id = :jobId", [
                'userId'=> $userId,
                'jobId' => $job->job_id
            ])->fetch();
        
            // inspect_and_die($exists);

        loadView('jobs/job_details', [
            'job' => $job,
            'exists'=>$exists
            ]);

    }

    // Display create job form
    public function create(){
        loadView('jobs/create');
    }

    // Delete Job
    public function deleteJob($params){
        
        $id = $params['id'] ?? null;

        // $id = (int) $id;
        $params=[
            'id'=> $id
        ];
        $job = $this->db->query("SELECT * FROM jobs WHERE job_id = :id", $params)->fetch();
        if(!$job){
            ErrorController::error404("Job with id: {$id} doesn't exist ... ");
            return;
        }
        
         // check if user is the owner
        if(!Session::isOwner($job->user_id)){
            alert('danger', 'You are not the post owner');
            redirect('/');
        }
        
        $this->db->query("Delete FROM jobs WHERE job_id = :id", $params);

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
                
        $new_listing_data['user_id'] = Session::get('user')['user']->user_id;
        // inspect_and_die(Session::get('user')['user']->user_id);
        $new_listing_data=array_map('sanitizeData', $new_listing_data);
        // inspect_and_die($new_listing_data);
                
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
                                            
            $query = "INSERT INTO jobs ({$fields}) VALUES ({$values})";
                           
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
        $job = $this->db->query("SELECT * FROM jobs WHERE job_id = :id", $params)->fetch();


        // check if the current user owns the job post
        if(!Session::isOwner($job->user_id)){
            alert('danger', 'You are not the post owner');
            redirect('/');
        }

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
        $job = $this->db->query("SELECT * FROM jobs WHERE job_id = :id", $params)->fetch();
        $benefits = explode(',', $job->benefits ?? "");
        // inspect_and_die($job);
        if(!$job){
            ErrorController::error404("This job does not exist.");
            return;
        }
        
        // check if user is the owner
        if(!Session::isOwner($job->user_id)){
            alert('danger', 'You are not the post owner');
            redirect('/');
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
                $query = "UPDATE jobs SET $updateFields WHERE job_id = :id";
                $updatedValues['id'] = $id;

                // inspect_and_die($updatedValues);
                $this->db->query($query, $updatedValues);
                alert('success', "Job has been updated successfully!");
                   
                redirect('/job/job_details/'. $id);
            };

                           
                
        
            
    }


    // search functionality
    public function search(){
        // $userId = Session::get('user')['user']->user_id ?? null;
        $user = Session::get('user')['user'] ?? null;
        $userId = $user->user_id ?? null;
        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';

        $query = "SELECT * FROM jobs WHERE 
        role ILIKE :keywords OR 
        salary::text ILIKE :keywords OR 
        requirements ILIKE :keywords OR 
        description ILIKE :keywords OR 
        modality ILIKE :keywords OR 
        company_name ILIKE :keywords OR
        job_location ILIKE :keywords order by updated_at desc";

        $params = [
            'keywords' => "%{$keywords}%"
        ];

        $jobs = $this->db->query($query, $params)->fetchAll();
        $saved_ids = [];
        $applied_ids = [];

        if($userId){

            // check if user saved it
            $exists= $this->db->query("SELECT * 
                FROM saved_jobs 
                WHERE user_id = :userId",[
                    'userId'=> $userId,
                ])->fetchAll();
            $saved_ids = array_column($exists, 'job_id');
    
            //check if user applied it
            $applied = $this->db->query("SELECT * 
                FROM applied_jobs
                WHERE user_id = :userId", [
                     'userId'=> $userId,
                    //  'jobId' => $jobs['job_id']
                ])->fetchAll();
            $applied_ids = array_column($applied, 'job_id');
        }



        loadView('jobs/index', [
            'jobs' => $jobs, 
            'saved_ids' => $saved_ids, 
            'applied_ids' => $applied_ids]);
        
    }


    public function saveJob($params){
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];

        $user_id = Session::get('user')['user']->user_id;

        $job = $this->db->query("SELECT * FROM jobs WHERE job_id = :id", $params)->fetch();

        $exists = $this->db->query(
            "SELECT * FROM saved_jobs WHERE user_id = :user_id AND job_id = :job_id",
            [
                'user_id' => $user_id,
                'job_id' => $job->job_id
            ]
        )->fetch();

        

        // if it doesn't exist
        if(!$job){
            
            alert('danger', 'This job does not exist...');
            redirect('/');
        }

        // If exist, toggle it
        if($exists){
            $this->db->query(
                "DELETE FROM saved_jobs WHERE user_id = :user_id AND job_id = :job_id",
                [
                    'user_id' => $user_id,
                    'job_id' => $job->job_id
                ]
            );

            alert('success', 'Job unsaved');
            redirect($_SERVER['HTTP_REFERER']);

        } else {
            // if it doesnt exist, add the saved

            // Insert 
            $query = "INSERT INTO saved_jobs (job_id, user_id) VALUES(:job_id, :user_id)";
            $values = [
                "job_id" => $job->job_id,
                "user_id" => $user_id,
            ];
            $saved = $this->db->query($query, $values);
            
            alert('success', 'Job saved successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } 
        

    }


    public function applyJob($params){
        
        $id = $params['id'] ?? '';
        $params=[
            'id'=> $id
        ];
        $user_id = Session::get('user')['user']->user_id;

        $job = $this->db->query("SELECT * FROM jobs WHERE job_id = :id", $params)->fetch();
        

        // if it doesn't exist
        if(!$job){
            
            alert('danger', 'This job does not exist...');
            redirect('/');
        }

        // check if applied 
        $exists = $this->db->query(
            "SELECT * FROM applied_jobs WHERE user_id = :user_id AND job_id = :job_id",
            [
                'user_id' => $user_id,
                'job_id' => $job->job_id
            ]
        )->fetch();

        // if applied, remove it
        if($exists){
            $this->db->query(
                "DELETE FROM applied_jobs WHERE user_id = :user_id AND job_id = :job_id",
                [
                    'user_id' => $user_id,
                    'job_id' => $job->job_id
                ]
            );

            alert('success', 'Application cancelled');
            redirect($_SERVER['HTTP_REFERER']);
        }else {
            //otherwise, insert it
            // if it doesnt exist, add the saved

            // Insert 
            $query = "INSERT INTO applied_jobs (job_id, user_id, status) VALUES(:job_id, :user_id, :status)";
            $values = [
                "job_id" => $job->job_id,
                "user_id" => $user_id,
                "status" => 'Pending'
            ];
            $saved = $this->db->query($query, $values);
            
            alert('success', "You've applied successfully");
            redirect($_SERVER['HTTP_REFERER']);
        }
       
        
    
    }


    public function updateJobStatus($params){
        $owner_id = Session::get('user')['user']->user_id;
        $job_id = $params['id'] ?? null;
        $applicant_id = $_POST['applicant_id'] ?? null;
        $status = $_POST['status'] ?? null;

        // check if job exist
        $job = $this->db->query("SELECT * FROM applied_jobs a
            JOIN jobs j
            ON a.job_id = j.job_id
            WHERE a.job_id = :id", $params)->fetch();

        if(!$job){
            ErrorController::error404("Job with id {$id} doesn't exist ... ");
            return;
        }
        
        // check if user (logged) is the owner
        $belongs_to_owner = $this->db->query("
            SELECT *
            FROM jobs j
            JOIN applied_jobs a
            ON j.job_id = a.job_id
            WHERE j.user_id = :ownerId
            AND j.job_id = :id
            ", [
                'ownerId' => $owner_id,
                'id' => $job_id
            ])->fetch();

        if(!$belongs_to_owner){
            ErrorController::error403("Unauthorized.");
            return;
        }


        // Update application
        $this->db->query("
            UPDATE applied_jobs
            SET status = :status
            WHERE job_id = :jobId
            AND user_id = :applicantId
        ", [
            'status' => $status,
            'jobId' => $job_id,
            'applicantId' => $applicant_id
        ]);

        alert('success', "Application updated");
        redirect($_SERVER['HTTP_REFERER']);

    }


    public function cancelJobApplication($params){
        $owner_id = Session::get('user')['user']->user_id ?? null;
        
        // job id from params
        $id = $params['id'] ?? null;
        $applicant_id = $_POST['applicant_id'] ?? null;
        
        $params=[
            'id'=> $id,
           
        ];

        // check if job exist
        $job = $this->db->query("SELECT * FROM applied_jobs a
            JOIN jobs j
            ON a.job_id = j.job_id
            WHERE a.job_id = :id", $params)->fetch();

        if(!$job){
            ErrorController::error404("Job with id {$id} doesn't exist ... ");
            return;
        } 

        // check if user (logged) is the owner
        $belongs_to_owner = $this->db->query("
        SELECT *
        FROM jobs j
        JOIN applied_jobs a
        ON j.job_id = a.job_id
        WHERE j.user_id = :ownerId
        AND j.job_id = :id
        ", [
            'ownerId' => $owner_id,
            'id' => $id
        ])->fetch();

        if(!$belongs_to_owner){
            ErrorController::error403("Unauthorized.");
            return;
        }

        // cancel application
        $this->db->query("DELETE FROM applied_jobs
            WHERE job_id = :jobId
            AND user_id = :applicantID
        ", [
            'jobId' => $id,
            'applicantID' => $applicant_id
        ]);
       
        alert('success', "Application cancelled");
        redirect($_SERVER['HTTP_REFERER']);

    }

    


}

?>
                             