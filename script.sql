-- USERS
CREATE TABLE IF NOT EXISTS users (
    user_id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255) NOT NULL,
    agreement VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- JOBS
CREATE TABLE IF NOT EXISTS jobs (
    job_id SERIAL PRIMARY KEY,
    role VARCHAR(255) NOT NULL,
    salary INT NOT NULL,
    requirements VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    modality VARCHAR(100) DEFAULT 'no',
    company_name VARCHAR(255) NOT NULL,
    job_location VARCHAR(255) NOT NULL,
    company_about VARCHAR(255) NOT NULL,
    benefits VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_jobs_user
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- SAVED JOBS
CREATE TABLE IF NOT EXISTS saved_jobs (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    job_id INT NOT NULL,
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT unique_saved_job UNIQUE (user_id, job_id),
    CONSTRAINT fk_saved_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_saved_job FOREIGN KEY (job_id) REFERENCES jobs(job_id) ON DELETE CASCADE
);

-- APPLIED JOBS
CREATE TABLE IF NOT EXISTS applied_jobs (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    job_id INT NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT unique_applied_job UNIQUE (user_id, job_id),
    CONSTRAINT check_status
        CHECK (status IN ('Pending', 'Reviewing', 'Interviewing', 'Accepted', 'Rejected')),
    CONSTRAINT fk_applied_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_applied_job FOREIGN KEY (job_id) REFERENCES jobs(job_id) ON DELETE CASCADE
);

-- PASSWORD RESET
CREATE TABLE IF NOT EXISTS password_reset (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    tokenHashed VARCHAR(64) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reset_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- SEED DATA (SAFE - NO DUPLICATES)
INSERT INTO users (name, email, password, agreement)
VALUES
('jhon', 'jhon@example.com', '12345', 'agree'),
('jane', 'jane@example.com', '12345', 'agree')
ON CONFLICT (email) DO NOTHING;

-- JOBS SEED
INSERT INTO jobs (role, salary, requirements, description, modality, company_name, job_location, company_about, benefits, user_id)
VALUES
('Frontend Developer', 60000, 'HTML, CSS, JavaScript', 'Develop web interfaces', 'Remote', 'TechCorp', 'New York', 'Leading tech company', '401k, pto, vacations', 1),
('Backend Developer', 70000, 'PHP, MySQL, APIs', 'Develop server-side logic', 'Remote', 'SoftSolutions', 'San Francisco', 'Innovative software firm', '401k, pto, vacations', 1),
('Data Analyst', 55000, 'SQL, Excel, Python', 'Analyze business data', 'Hybrid', 'DataInsights', 'Chicago', 'Data-driven analytics company', '401k, pto, vacations', 1),
('Project Manager', 65000, 'Agile, Scrum, Leadership', 'Manage projects from start to finish', 'Remote', 'BuildIt Inc.', 'Austin', 'Construction and tech projects', '401k, pto, vacations', 1),
('UX Designer', 58000, 'Figma, Adobe XD, Research', 'Design user experiences', 'Remote', 'DesignHive', 'Los Angeles', 'Creative design agency', '401k, pto, vacations', 2),
('Data Engineer', 88000, 'Analytics', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
('Solutions Engineer', 55000, 'Testing, Automation, Selenium', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
('Web Consultant', 82000, 'HTML, CSS, JS, PHP', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
('AI Engineer', 93000, 'PyTorch, TensorFlow', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2),
('Big Data Engineer', 74000, 'Snowflake, Python', 'Test software products', 'Remote', 'CodeCheck', 'Boston', 'Quality assurance firm', '401k, pto, vacations', 2);