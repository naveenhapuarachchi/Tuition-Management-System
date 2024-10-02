

- open the xammp go the my sql admin

- create a databse  lms_database (lms name)

- upload the databse code (lms_database.txt)

- having a 2 tables

Database Name - lms_database

CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(15) NOT NULL, -- Changed from NIC
    password VARCHAR(255) NOT NULL, -- Changed from first_name, store as a hashed value
    full_name VARCHAR(100) NOT NULL, -- Changed from last_name
    initials VARCHAR(10),
    birthday DATE,
    gender ENUM('male', 'female') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mobile VARCHAR(15),
    whatsapp VARCHAR(15),
    address1 VARCHAR(100),
    address2 VARCHAR(100),
    city VARCHAR(50),
    school VARCHAR(100),
    exam_year INT,
    medium ENUM('sinhala', 'english', 'tamil'),
    source TEXT,
    profile_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Use your existing database
USE lms_database;

-- Create or modify the attendance table to include user_id
CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) UNSIGNED NOT NULL,
    username VARCHAR(100) NOT NULL,
    full_name VARCHAR(150),
    date DATE,
    time TIME,
    status VARCHAR(20) DEFAULT 'Present',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);
