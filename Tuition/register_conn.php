<?php
// Start output buffering
ob_start();

// Include the database connection file
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data with updated field names
    $username = $_POST['username']; // Username field from form
    $password = $_POST['password']; // Plain text password from form
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $full_name = $first_name . ' ' . $last_name; // Combine first and last name for full name
    $initials = $_POST['initial'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $whatsapp = $_POST['whatsapp'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $school = $_POST['school'];
    $exam_year = $_POST['exam'];
    $medium = $_POST['medium'];
    $source = $_POST['source'];

    // Handle file upload for profile image
    $profile_image = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }
        $profile_image = $upload_dir . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image);
    }

    // Check if the username already exists in the database
    $check_user_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = $conn->query($check_user_query);
    if ($check_result->num_rows > 0) {
        echo "Username or email already exists. Please choose a different one.";
        exit();
    }

    // Securely hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insert_query = "INSERT INTO users (username, password, full_name, initials, birthday, gender, email, mobile, whatsapp, address1, address2, city, school, exam_year, medium, source, profile_image) 
            VALUES ('$username', '$hashed_password', '$full_name', '$initials', '$birthday', '$gender', '$email', '$mobile', '$whatsapp', '$address1', '$address2', '$city', '$school', '$exam_year', '$medium', '$source', '$profile_image')";

    if ($conn->query($insert_query) === TRUE) {
        // If registration is successful, redirect to the success page
        header("Location: login.html");
        exit();
    } else {
        // Show the SQL error if there is any
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid Request Method!";
}

// End output buffering and flush output
ob_end_flush();

?>
