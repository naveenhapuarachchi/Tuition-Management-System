This is Assignment of our Campus, 
         
         Subject - Advanced Networking

         Owners - Naveen Hapuarachchi, Malsha Pinto

[Naveen Hapuarachchi](https://github.com/naveenhapuarachchi), 

[Malsha Pinto](https://github.com/malshapinto99)

# Tuition-Management-System
The Tuition Management System is a comprehensive web application designed to streamline the management of student registrations, course enrollments, and payments for educational institutes and tuition centers. It simplifies the administrative tasks associated with managing students and course details, 



- open the xammp go the my sql admin

- create a databse  lms_database (lms name)

- upload the databse code (lms_database.txt)

- having a 2 tables
- 1-user table
- 2-attendance table

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
//Create an Attendance table
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


---

# Web-Based - Tuition Class Management System (FOHELearn)

![GitHub](https://img.shields.io/badge/PHP-8.0%2B-blue) ![GitHub](https://img.shields.io/badge/MySQL-5.7%2B-orange) ![GitHub](https://img.shields.io/badge/License-MIT-green)  

## 📌 Overview  
The **Tuition Class Management System** is a web-based platform designed to automate administrative tasks for ABC Institute, replacing error-prone manual processes (e.g., spreadsheets, paper records) with a centralized solution. It streamlines student registration, class scheduling, fee management, attendance tracking, and performance monitoring for admins, lecturers, and students.  

         Images

![website home](https://github.com/user-attachments/assets/75819825-04bf-4b1e-b60d-745e36de9438)
![website about](https://github.com/user-attachments/assets/195431e1-4e98-4dea-8a17-f047fd82b1f7)
![LMS Register](https://github.com/user-attachments/assets/98dc8dec-ca23-440e-89a3-06e3719b39e8)
![LMS Login](https://github.com/user-attachments/assets/604820b5-132f-4082-a374-6cdbc8ee7522)
![LMS Dashboard](https://github.com/user-attachments/assets/0e8c521a-0d1a-4e24-ba8d-53d08e41fcc8)




## 🎯 Key Features  
### **Admin Panel**  
- Manage student/lecturer profiles (add, edit, delete).  
- Create and update class schedules.  
- Track fee payments, generate reports, and send reminders.  
- Monitor attendance and academic performance.  

### **Lecturer Panel**  
- View assigned class schedules and student lists.  
- Track attendance and submit academic feedback.  

### **Student Panel**  
- Access class schedules and enrolled course details.  
- Pay fees online and view payment history.  
- Check attendance records and academic performance.  

### **Core Functionalities**  
- Automated attendance tracking and report generation.  
- Secure online fee payment integration.  
- Real-time updates for schedules and payments.  

## 🛠️ Tech Stack  
| **Frontend** | **Backend** | **Database** | **Tools** |  
|--------------|-------------|--------------|-----------|  
| HTML         | PHP         | MySQL        | XAMPP     |  
| CSS          | Apache      |              |           |  
| JavaScript   |             |              |           |  

## ⚙️ System Architecture  
- **Frontend**: Responsive UI built with HTML/CSS/JavaScript.  
- **Backend**: PHP handles authentication, form submissions, and business logic.  
- **Database**: MySQL stores student profiles, schedules, fees, and attendance.  
- **Security**: Encrypted passwords, role-based access control.  

## ✅ Functional Requirements  
- **Admin**: Manage users, schedules, fees, and generate reports.  
- **Lecturers**: View schedules, track attendance, and submit performance data.  
- **Students**: Access schedules, pay fees, and view feedback.  

## 🔒 Non-Functional Requirements  
- **Performance**: Supports 500+ concurrent users with <2s response time.  
- **Scalability**: Modular design for future expansion.  
- **Security**: SSL encryption for data and payments.  
- **Availability**: 99.9% uptime with minimal downtime.  

## 🌟 Benefits  
- Reduces manual errors and administrative workload.  
- Enhances communication between staff, students, and lecturers.  
- Streamlines fee management and class scheduling.  
- Supports remote learning environments.  

## 🚧 Future Enhancements  
- Mobile app integration.  
- Parent portal for performance tracking.  
- AI-driven analytics for student progress.  

## 📄 License  
This project is licensed under the MIT License.  

---

### 💻 **Contribution**  
Contributions are welcome! Fork the repository, create a branch, and submit a PR.  

---
