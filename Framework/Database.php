<?php

namespace Framework;
use PDO;

// PDO connection
// PHP Data Objects.
// A layer to connect php with the database
class Database{
    public $conn;

    // initiate the connection
    public function __construct($config){
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            // echo'connected';
        } catch (PDOException $e) {
            throw new Exception("Database failed to connect: {$e->getMessage()}");
        }
    }

    // Query the DB
    public function query($query, $params=[]){
        try {
            $statement = $this->conn->prepare($query);
            foreach($params as $param =>$value){
                $statement->bindValue(':' . $param, $value);
            }
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: {$e->getMessage()}");
        }
    }

    // reset the db
    public function resetDB($dbname){

        try {
            // Drop and create DB
            $this->conn->exec("DROP DATABASE IF EXISTS {$dbname}");
            echo "Database '$dbname' dropped successfully.<br>";
            $this->conn->exec("CREATE DATABASE {$dbname}");
            echo "Database '$dbname' created successfully.<br>";


            // Use DB
            $this->conn->exec("USE `$dbname`");

            // Create User table
            $sql_users_table = "CREATE TABLE IF NOT EXISTS users (
                user_id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email varchar(255) unique,
                password varchar(255) not null,
                agreement varchar(100) not null,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $this->conn->exec($sql_users_table);
            echo "Users table created successfully.<br>";

            // Insert Users
            $sql_insert_users = "INSERT INTO users (name, email, password, agreement) VALUES
            ('jhon', 'jhon@example.com', '12345', 'agree'),
            ('jane', 'jane@example.com', '12345', 'agree')";
            $this->conn->exec($sql_insert_users);
            echo "Users inserted successfully.<br>";

            // Create jobs table
            $sql_jobs_table = "CREATE TABLE IF NOT EXISTS jobs (
                job_id INT AUTO_INCREMENT PRIMARY KEY,
                role VARCHAR(255) NOT NULL,
                salary int not null,
                requirements varchar(255) not null,
                description varchar(255) not null,
                modality varchar(100) default 'no',
                company_name varchar(255) not null,
                job_location varchar(255) not null,
                company_about varchar(255) not null,
                benefits varchar(255) not null,
                user_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
            )";
            $this->conn->exec($sql_jobs_table);
            echo "Jobs table created successfully.<br>";

            // Insert jobs
            $sql_insert_jobs = "INSERT INTO jobs (role, salary, requirements, description, modality, company_name, job_location, company_about, benefits, user_id) VALUES
                ('Frontend Developer', 60000, 'HTML, CSS, JavaScript', 'Develop web interfaces', 'Remote', 'TechCorp', 'New York', 'Leading tech company', '401k, pto, vacations', 1),
                ('Backend Developer', 70000, 'PHP, MySQL, APIs', 'Develop server-side logic', 'Remote', 'SoftSolutions', 'San Francisco', 'Innovative software firm', '401k, pto, vacations', 1),
                ('Data Analyst', 55000, 'SQL, Excel, Python', 'Analyze business data', 'Hybrid', 'DataInsights', 'Chicago', 'Data-driven analytics company', '401k, pto, vacations', 1),
                ('Project Manager', 65000, 'Agile, Scrum, Leadership', 'Manage projects from start to finish', 'Remote', 'BuildIt Inc.', 'Austin', 'Construction and tech projects', '401k, pto, vacations', 1),
                ('UX Designer', 58000, 'Figma, Adobe XD, Research', 'Design user experiences', 'Remote', 'DesignHive', 'Los Angeles', 'Creative design agency', '401k, pto, vacations', 2),
                ('Data Engineer', 88000, 'Analize ', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
                ('Solutions Engineer', 55000, 'Testing, Automation, Selenium', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
                ('Web Consultant', 82000, 'HTML, CSS, JS, PHP', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
                ('AI Engineer', 93000, 'Pytorch, tensorflow', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
                ('Big Data Engineer', 74000, 'Snowflake, python', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2)
            ";
            $this->conn->exec($sql_insert_jobs);
            echo "Jobs inserted successfully.<br>";


            // create saved jobs table
            $sql_insert_savedJobs = "CREATE TABLE saved_jobs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                job_id INT NOT NULL,
                saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY unique_saved_job (user_id, job_id),

                FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
                FOREIGN KEY (job_id) REFERENCES jobs(job_id) ON DELETE CASCADE
            )";
            $this->conn->exec($sql_insert_savedJobs);
            echo "Saved Jobs table created successfully.<br>";

            // create applied jobs table
            $sql_insert_appliedJobs = "CREATE TABLE applied_jobs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                job_id INT NOT NULL,
                status ENUM('Pending', 'Reviewing', 'Interviewing', 'Accepted', 'Rejected' ) DEFAULT 'Pending',
                applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                UNIQUE KEY unique_applied_job (user_id, job_id),

                FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
                FOREIGN KEY (job_id) REFERENCES jobs(job_id) ON DELETE CASCADE
            )";
            $this->conn->exec($sql_insert_appliedJobs);
            echo "Applied Jobs table created successfully.<br>";



            $sql_create_reset_psw = "CREATE TABLE password_reset (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                tokenHashed VARCHAR(64) NOT NULL,
                expires_at TIMESTAMP NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
            )";
            $this->conn->exec($sql_create_reset_psw);
            echo "Reset password table created successfully.<br>";

        } catch (Throwable $e) {
            throw new Exception("Error during resetAll: " . $e->getMessage());
        }
    }
}
?>