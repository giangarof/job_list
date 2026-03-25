<?php

// PDO connection
class Database{
    public $conn;

    // initiate the connection
    public function __construct($config){
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            // echo'connected';
        } catch (PDOException $e) {
            throw new Exception("Database failed to connect: {$e->getMessage()}");
        }
    }

    // reset the db
    public function resetDB($dbname){

        try {
            // Drop and create DB
            $this->conn->exec("DROP DATABASE IF EXISTS {$dbname}");
            echo "Database '$dbname' dropped successfully.\n";
            $this->conn->exec("CREATE DATABASE {$dbname}");
            echo "Database '$dbname' created successfully.\n";


            // Use DB
            $this->conn->exec("USE `$dbname`");

            // Create User table
            $sql_users_table = "CREATE TABLE IF NOT EXISTS users (
                user_id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email varchar(255) unique,
                password varchar(255) not null,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $this->conn->exec($sql_users_table);
            echo "Users table created successfully.\n";

            // Insert Users
            $sql_insert_users = "INSERT INTO users (name, email, password) VALUES
            ('jhon', 'jhon@example.com', '12345'),
            ('jane', 'jane@example.com', '12345')";
            $this->conn->exec($sql_insert_users);
            echo "Users inserted successfully.\n";

            // Create listings table
            $sql_listings_table = "CREATE TABLE IF NOT EXISTS listings (
                job_id INT AUTO_INCREMENT PRIMARY KEY,
                role VARCHAR(255) NOT NULL,
                salary int not null,
                requirements varchar(255) not null,
                description varchar(255) not null,
                remote varchar(100) default 'no',
                company_name varchar(255) not null,
                job_location varchar(255) not null,
                company_about varchar(255) not null,
                benefits varchar(255) not null,
                user_id INT NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
            )";
            $this->conn->exec($sql_listings_table);
            echo "Jobs table created successfully.\n";

            // Insert jobs
            $sql_insert_jobs = "INSERT INTO listings (role, salary, requirements, description, remote, company_name, job_location, company_about, benefits, user_id) VALUES
                ('Frontend Developer', 60000, 'HTML, CSS, JavaScript', 'Develop web interfaces', 'Yes', 'TechCorp', 'New York', 'Leading tech company', 'Health insurance, 401k', 1),
                ('Backend Developer', 70000, 'PHP, MySQL, APIs', 'Develop server-side logic', 'No', 'SoftSolutions', 'San Francisco', 'Innovative software firm', 'Remote options, Paid vacation', 1),
                ('Data Analyst', 55000, 'SQL, Excel, Python', 'Analyze business data', 'Hybrid', 'DataInsights', 'Chicago', 'Data-driven analytics company', 'Gym membership, Flexible hours', 1),
                ('Project Manager', 65000, 'Agile, Scrum, Leadership', 'Manage projects from start to finish', 'Yes', 'BuildIt Inc.', 'Austin', 'Construction and tech projects', 'Health insurance, Bonus plan', 1),
                ('UX Designer', 58000, 'Figma, Adobe XD, Research', 'Design user experiences', 'Yes', 'DesignHive', 'Los Angeles', 'Creative design agency', 'Remote work, Training budget', 2),
                ('QA Engineer', 60000, 'Testing, Automation, Selenium', 'Test software products', 'No', 'CodeCheck', 'Boston', 'Quality assurance firm', 'Paid time off, Health insurance', 2)
            ";
            $this->conn->exec($sql_insert_jobs);
            echo "Jobs inserted successfully.\n";
        } catch (\Throwable $th) {
            throw new Exception("Error during resetAll: " . $e->getMessage());
        }
    }
}

// // 1 Creat the connection
// $conn = mysqli_connect("localhost", "admin", "12345678",);

// // 2 check the connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// // 3 create DB query

// $sql_createDB = "DROP DATABASE IF EXISTS jobs; CREATE DATABASE jobs;";
// if (mysqli_multi_query($conn, $sql_createDB)) {
//     while (mysqli_more_results($conn) && mysqli_next_result($conn)) {}
//     echo "Database reset successfully!" . "\n";
// } else {
//     echo "Error: " . mysqli_error($conn);
// }

// // 4 Select the DB
// mysqli_select_db($conn, "jobs");


// // 5 create user table
// $sql_user_table = "CREATE TABLE IF NOT EXISTS users (
//     user_id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(255) NOT NULL,
//     email varchar(255) unique,
//     password varchar(255) not null,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

// )";

// if (mysqli_query($conn, $sql_user_table)) {
//     echo "User table created successfully\n";
// } else {
//     echo "Error: " . mysqli_error($conn) . "\n";
// }

// // 6 Insert users
// $sql_insert_users = "INSERT INTO users (name, email, password) VALUES
// ('jhon', 'jhon@example.com', '12345'),
// ('jane', 'jane@example.com', '12345')";

// if (mysqli_query($conn, $sql_insert_users)) {
//     echo "Users inserted successfully!\n";
// } else {
//     echo "Users already exist or error: " . mysqli_error($conn) . "\n";
// }

// // 7 create listing tables
// $sql_listings_table = "CREATE TABLE IF NOT EXISTS listings (
//     job_id INT AUTO_INCREMENT PRIMARY KEY,
//     role VARCHAR(255) NOT NULL,
//     salary int not null,
//     requirements varchar(255) not null,
//     description varchar(255) not null,
//     remote varchar(100) default 'no',
//     company_name varchar(255) not null,
//     job_location varchar(255) not null,
//     company_about varchar(255) not null,
//     benefits varchar(255) not null,
//     user_id INT NOT NULL,
//     FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE

// )";

// if (mysqli_query($conn, $sql_listings_table)) {
//     echo "Listing table created successfully\n";
// } else {
//     echo "Error: " . mysqli_error($conn) . "\n";
// }

// // 8 Insert jobs
// $sql_insert_jobs = "INSERT INTO listings (role, salary, requirements, description, remote, company_name, job_location, company_about, benefits, user_id) VALUES
//     ('Frontend Developer', 60000, 'HTML, CSS, JavaScript', 'Develop web interfaces', 'Yes', 'TechCorp', 'New York', 'Leading tech company', 'Health insurance, 401k', 1),
//     ('Backend Developer', 70000, 'PHP, MySQL, APIs', 'Develop server-side logic', 'No', 'SoftSolutions', 'San Francisco', 'Innovative software firm', 'Remote options, Paid vacation', 1),
//     ('Data Analyst', 55000, 'SQL, Excel, Python', 'Analyze business data', 'Hybrid', 'DataInsights', 'Chicago', 'Data-driven analytics company', 'Gym membership, Flexible hours', 1),
//     ('Project Manager', 65000, 'Agile, Scrum, Leadership', 'Manage projects from start to finish', 'Yes', 'BuildIt Inc.', 'Austin', 'Construction and tech projects', 'Health insurance, Bonus plan', 1),
//     ('UX Designer', 58000, 'Figma, Adobe XD, Research', 'Design user experiences', 'Yes', 'DesignHive', 'Los Angeles', 'Creative design agency', 'Remote work, Training budget', 2),
//     ('QA Engineer', 60000, 'Testing, Automation, Selenium', 'Test software products', 'No', 'CodeCheck', 'Boston', 'Quality assurance firm', 'Paid time off, Health insurance', 2)
// ";

// if (mysqli_query($conn, $sql_insert_jobs)) {
//     echo "Jobs inserted successfully!";
// } else {
//     echo "Error inserting jobs: " . mysqli_error($conn);
// }


// mysqli_close($conn);
?>