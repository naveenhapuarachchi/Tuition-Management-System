<?php
session_start();
include 'db_conn.php'; // Include your database connection file

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}

// Retrieve the user's information from the database
$user_id = $_SESSION['userid'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user details
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $whatsapp = $_POST['whatsapp'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $school = $_POST['school'];
    $exam_year = $_POST['exam_year'];
    $medium = $_POST['medium'];
    
    // Handle file upload for profile image
    $profile_image = $user['profile_image']; // Keep existing image
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }
        $profile_image = $upload_dir . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image);
    }

    // Prepare the update statement
    $update_stmt = $conn->prepare("UPDATE users SET username = ?, full_name = ?, email = ?, mobile = ?, whatsapp = ?, address1 = ?, address2 = ?, city = ?, school = ?, exam_year = ?, medium = ?, profile_image = ? WHERE id = ?");
    $update_stmt->bind_param("sssssissssssi", $username, $full_name, $email, $mobile, $whatsapp, $address1, $address2, $city, $school, $exam_year, $medium, $profile_image, $user_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . $conn->error . "');</script>";
    }
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgba(255, 255, 255, 0.8); /* White with transparency */
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: rgba(0, 0, 0, 0.8); /* Dark background with transparency */
            color: #fff;
            padding: 20px;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .menu {
            list-style: none;
            padding: 0;
        }

        .menu li {
            margin: 15px 0;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: #ffcc00; /* Change color on hover */
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Light background with transparency */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            padding: 10px 15px;
            background-color: #ffcc00; /* Colorful button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #e6b800; /* Darker shade on hover */
        }

        /* Form styles */
        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9); /* Input fields with transparency */
        }

        button[type="submit"] {
            padding: 10px 15px;
            background-color: #28a745; /* Green button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #218838; /* Darker shade on hover */
        }

        /* Additional styles for responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
            }
            .container {
                flex-direction: column;
            }
        }
       
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <img src="<?php echo $user['profile_image']; ?>" alt="Profile Image" class="profile-img">
                <p class="name"><?php echo $user['full_name']; ?></p>
                <p class="email"><?php echo $user['email']; ?></p>
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="timetable.php">Time Table</a></li>
                <li><a href="analysis.php">Performance Analysis</a></li>
                <li><a href="atten.php">Attendance Tracker</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="course_fee.html">Tuition Fee</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>My Profile</h1>
                <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
            </div>
            <div class="content">
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                    </div>
                    <div>
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div>
                        <label for="mobile">Mobile:</label>
                        <input type="text" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>">
                    </div>
                    <div>
                        <label for="whatsapp">WhatsApp:</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="<?php echo $user['whatsapp']; ?>">
                    </div>
                    <div>
                        <label for="address1">Address 1:</label>
                        <input type="text" id="address1" name="address1" value="<?php echo $user['address1']; ?>">
                    </div>
                    <div>
                        <label for="address2">Address 2:</label>
                        <input type="text" id="address2" name="address2" value="<?php echo $user['address2']; ?>">
                    </div>
                    <div>
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>">
                    </div>
                    <div>
                        <label for="school">School:</label>
                        <input type="text" id="school" name="school" value="<?php echo $user['school']; ?>">
                    </div>
                    <div>
                        <label for="exam_year">Exam Year:</label>
                        <input type="number" id="exam_year" name="exam_year" value="<?php echo $user['exam_year']; ?>">
                    </div>
                    <div>
                        <label for="medium">Medium:</label>
                        <select id="medium" name="medium">
                            <option value="sinhala" <?php echo ($user['medium'] == 'sinhala') ? 'selected' : ''; ?>>Sinhala</option>
                            <option value="english" <?php echo ($user['medium'] == 'english') ? 'selected' : ''; ?>>English</option>
                            <option value="tamil" <?php echo ($user['medium'] == 'tamil') ? 'selected' : ''; ?>>Tamil</option>
                        </select>
                    </div>
                    <div>
                        <label for="profile_image">Profile Image:</label>
                        <input type="file" id="profile_image" name="profile_image">
                    </div>
                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
