<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Analysis</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgba(240, 240, 240, 0.9);
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: rgba(0, 0, 0, 0.8);
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
            color: #ffcc00;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
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
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e6b800;
        }

        .analysis-content {
            margin-top: 20px;
        }

        .analysis-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .analysis-table th, .analysis-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .analysis-table th {
            background-color: #333;
            color: white;
        }

        .performance-summary {
            margin: 20px 0;
        }

        .summary-box {
            background-color: #f7f7f7;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        
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
                <h1>Performance Analysis</h1>
                <form method="post" action="logout.php">
                    <button class="logout-btn" type="submit">Logout</button>
                </form>
            </div>
            <div class="analysis-content">
                <p>Welcome to the Performance Analysis section! Track student progress in HTML, MySQL, PHP, CSS, jQuery, JavaScript, Bootstrap, React, and SASS.</p>

                <h2>Student Performance Overview</h2>
                <div class="performance-summary">
                    <div class="summary-box">
                        <h3>Overall Performance</h3>
                        <p>Average Grade: <strong>B+</strong></p>
                        <p>Top Subjects: HTML, PHP, JavaScript</p>
                    </div>
                    <div class="summary-box">
                        <h3>Areas of Improvement</h3>
                        <p>Subjects: SASS, React</p>
                        <p>Suggested Actions: Extra practice assignments and targeted tutorials</p>
                    </div>
                </div>

                <h2>Detailed Performance Report</h2>
                <table class="analysis-table">
                    <tr>
                        <th>Subject</th>
                        <th>Student</th>
                        <th>Grade</th>
                        <th>Attendance</th>
                        <th>Remarks</th>
                    </tr>
                    <tr>
                        <td>HTML</td>
                        <td>John Doe</td>
                        <td>A</td>
                        <td>95%</td>
                        <td>Excellent structure and code clarity</td>
                    </tr>
                    <tr>
                        <td>PHP</td>
                        <td>Jane Smith</td>
                        <td>B+</td>
                        <td>90%</td>
                        <td>Good understanding of backend logic</td>
                    </tr>
                    <tr>
                        <td>JavaScript</td>
                        <td>Mary Johnson</td>
                        <td>A</td>
                        <td>98%</td>
                        <td>Strong logic and problem-solving skills</td>
                    </tr>
                    <tr>
                        <td>SASS</td>
                        <td>David Lee</td>
                        <td>C+</td>
                        <td>85%</td>
                        <td>Needs improvement in styling techniques</td>
                    </tr>
                    <tr>
                        <td>React</td>
                        <td>Anna Taylor</td>
                        <td>B</td>
                        <td>88%</td>
                        <td>Good component design, needs more practice</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer">
        &copy; copyright @ 2024 by <span>Naveen Hapuarachchi</span> | all rights reserved!
    </footer>
</body>
</html>
