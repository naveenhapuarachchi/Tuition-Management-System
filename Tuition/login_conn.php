<?php
session_start();
include 'db_conn.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login, set session variables
            $_SESSION['userid'] = $user['id']; // User ID
            $_SESSION['username'] = $user['username']; // Username
            $_SESSION['full_name'] = $user['full_name']; // Full name
            $_SESSION['email'] = $user['email']; // User email
            $_SESSION['profile_image'] = $user['profile_image']; // Profile image path

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Username!'); window.location.href='login.html';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit();
}
?>
