<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "lms_database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle attendance marking
if (isset($_POST['mark_attendance'])) {
    $user_id = $_SESSION['userid']; // Get user_id from session
    $username = $_SESSION['username'];
    $full_name = $_SESSION['full_name'];
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $status = "Present";

    // Insert attendance record
    $sql = "INSERT INTO attendance (user_id, username, full_name, date, time, status) 
            VALUES ('$user_id', '$username', '$full_name', '$date', '$time', '$status')";

    if ($conn->query($sql) === TRUE) {
        $notification = "Attendance marked successfully for $full_name at $time on $date.";
    } else {
        $notification = "Error marking attendance: " . $conn->error;
    }
}

// Fetch all attendance records for the logged-in user
$userid = $_SESSION['userid'];
$attendanceRecords = $conn->query("SELECT * FROM attendance WHERE user_id = '$userid' ORDER BY date DESC, time DESC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracker</title>
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

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        .notification {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
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
                <h1>Attendance Tracker</h1>
                <form method="post" action="logout.php">
                    <button class="logout-btn" type="submit">Logout</button>
                </form>
            </div>

            <!-- Notification Message -->
            <?php if (isset($notification)) { ?>
                <p class="notification"><?php echo $notification; ?></p>
            <?php } ?>

            <!-- Attendance Form -->
            <div class="attendance-form">
                <form method="post">
                    <button type="submit" name="mark_attendance">Mark Attendance</button>
                </form>
            </div>

            <!-- Display Attendance Records -->
            <h2>Your Attendance Records</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th> <!-- Add Username column -->
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
                <?php
                // Reconnect to fetch records since the connection is closed after marking attendance
                $conn = new mysqli("localhost", "root", "", "lms_database");
                $attendanceRecords = $conn->query("SELECT * FROM attendance WHERE user_id = '$userid' ORDER BY date DESC, time DESC");

                if ($attendanceRecords->num_rows > 0) {
                    while ($row = $attendanceRecords->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>"; // Display Username
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No attendance records found.</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>

    <footer class="footer">
        &copy; copyright @ 2024 by <span>Naveen Hapuarachchi</span> | All rights reserved!
    </footer>
</body>
</html>
