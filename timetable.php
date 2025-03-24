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
    <title>Timetable</title>
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
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e6b800;
        }

        .timetable {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .timetable th, .timetable td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .timetable th {
            background: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        .monday { background-color: #ffadad; }
        .tuesday { background-color: #ffd6a5; }
        .wednesday { background-color: #fdffb6; }
        .thursday { background-color: #caffbf; }
        .friday { background-color: #9bf6ff; }
        .saturday { background-color: #a0c4ff; }
        .sunday { background-color: #bdb2ff; }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
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
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
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
                <a href="dashboard.php"><h1>Class Timetable</h1></a>
                <form method="post" action="logout.php">
                    <button class="logout-btn" type="submit">Logout</button>
                </form>
            </div>
            <div class="content">
                <table class="timetable">
                    <tr>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                    <tr>
                        <td>8:00 - 10:00</td>
                        <td class="monday">HTML</td>
                        <td class="tuesday">CSS</td>
                        <td class="wednesday">react</td>
                        <td class="thursday">MySQL</td>
                        <td class="friday">JQuery</td>
                        <td class="saturday"> PHP </td>
                        <td class="sunday">SASS</td>
                    </tr>
                    <tr>
                        <td>10:00 - 12:00</td>
                        <td class="monday">CSS</td>
                        <td class="tuesday">HTML</td>
                        <td class="wednesday">react</td>
                        <td class="thursday">MySQL</td>
                        <td class="friday">SASS</td>
                        <td class="saturday">PHP</td>
                        <td class="sunday">MySQL</td>
                    </tr>
                    <tr>
                        <td>12:00 - 2:00</td>
                        <td class="monday">Computer Science</td>
                        <td class="tuesday">MySQL</td>
                        <td class="wednesday">PHP</td>
                        <td class="thursday">CSS</td>
                        <td class="friday">JQuery</td>
                        <td class="saturday">Java Script</Script></td>
                        <td class="sunday">Boostrap</td>
                    </tr>
                    <tr>
                        <td>2:00 - 4:00</td>
                        <td class="monday">react</td>
                        <td class="tuesday"> PHP  Science</td>
                        <td class="wednesday">SASS</td>
                        <td class="thursday">HTML</td>
                        <td class="friday">Java Script</td>
                        <td class="saturday">Boostrap</td>
                        <td class="sunday">MySQL</td>
                    </tr>
                    <tr>
                        <td>4:00 - 6:00</td>
                        <td class="monday">MySQL</td>
                        <td class="tuesday">PHP</td>
                        <td class="wednesday">SASS</td>
                        <td class="thursday">react</td>
                        <td class="friday">JQuery</td>
                        <td class="saturday">Boostrap</td>
                        <td class="sunday">Java Script</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <footer class="footer">
        &copy; copyright @ 2024 by <span>Naveen Hapuarachchi</span> | All rights reserved!
    </footer>
</body>
</html>
