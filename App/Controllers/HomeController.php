<?php 

namespace App\Controllers;
use Framework\Database;

use Framework\Session;
use PDO;

class HomeController{
    protected $db;
    public function __construct(){
        // die('HomeController');
        $config= require getBasePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index(){
        $userId = Session::get('user')['user']->user_id ?? null;
        $jobs = $this->db->query("SELECT * FROM jobs order by updated_at desc LIMIT 6")->fetchAll();
        // inspect($jobs);

        // check if user saved it
        $saved = $this->db->query("SELECT * 
            FROM saved_jobs 
            WHERE user_id = :userId",[
                'userId'=> $userId,
            ])->fetchAll();
        $saved_ids = array_column($saved, 'job_id');


        // check if user applied 
        $applied = $this->db->query("SELECT * 
            FROM applied_jobs
            WHERE user_id = :userId", [
                 'userId'=> $userId,
                //  'jobId' => $jobs['job_id']
            ])->fetchAll();
        $applied_ids = array_column($applied, 'job_id');

        // inspect_and_die($applied_ids);
        loadView('home', ['jobs' => $jobs, 'saved_ids' => $saved_ids, 'applied_ids' => $applied_ids]);
    }

}
?>