CREATE DATABASE admin_data;

USE admin_data;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    hk_type INT(11),
    course_code VARCHAR(50),
    hk_duty_status ENUM('Man Power', 'Facilitator', 'Office Duty'),
    rendered_hours INT(11),
    schedule_days VARCHAR(255)  
);

CREATE TABLE hk_student_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    date DATE NOT NULL,
    time_in TIME,
    time_out TIME,
    remarks TEXT,
    no_of_hours DECIMAL(5,2),
    approval ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE
);

INSERT INTO students (id, name, hk_type, course_code, hk_duty_status, rendered_hours, schedule_days)
 VALUES (3, 'joshco', 50, 'bsit', 'Facilitator', 90, 'WEDNESDAY'), (4, 'joshco', 50, 'bsit', 'Facilitator', 90,'MONDAY'), (5, 'pogi', 75, 'BSCS', 'Man Power', 120, 'TUESDAY');
INSERT INTO admin (name, password, role) VALUES 
('admin', 'admin123', 'admin');