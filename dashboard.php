<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Assuming these session variables are set during login
// Make sure to set these session variables during login
// $_SESSION['userid'] = $user['id'];
// $_SESSION['username'] = $user['username'];
// $_SESSION['full_name'] = $user['full_name'];
// $_SESSION['email'] = $user['email'];
// $_SESSION['profile_image'] = $user['profile_image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgba(240, 240, 240, 0.9); /* Light grey with transparency */
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
            margin-bottom: 15px;
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
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e6b800; /* Darker shade on hover */
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
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333; /* Dark footer */
            color: white; /* White text in footer */
            position: relative;
            bottom: 0;
            width: 100%;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <!-- Displaying the user's profile image, name, and email -->
                <img src="<?php echo isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'default-profile.png'; ?>" alt="Profile Image" class="profile-img">
                <p class="name"><?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User Name'; ?></p>
                <p class="email"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'user@example.com'; ?></p>
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
            <a href="dashboard.php"><h1>LMS Dashboard</h1></a>
                <form method="post" action="logout.php">
                    <button class="logout-btn" type="submit">Logout</button>
                </form>
            </div>
            <div class="content">
                <!-- Dynamic content based on user role -->
                <p>Welcome, <span id="role">Student</span>!</p>
                <img src="images/dash1.jpg" style="width: 1100px; height: auto;">

            </div>
        </div>
    </div>

    
    <footer class="footer" align="center">
        &copy; copyright @ 2024 by <span>Naveen Hapuarachchi</span> | all rights reserved!
    </footer>
</body>
</html>
