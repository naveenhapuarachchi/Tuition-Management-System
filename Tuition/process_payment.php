<?php
session_start();
include 'db_conn.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $total = $amount * $quantity;

    // Here, you would integrate with your payment gateway (e.g., Stripe, PayPal) to process the payment.
    // Assuming payment is successful, we would set a session variable to grant access.

    // Simulating payment success for demonstration purposes
    $payment_success = true; // Replace with actual payment processing logic

    if ($payment_success) {
        $_SESSION['payment_success'] = true;
        $_SESSION['course_access'] = true; // Grant access to the course
        header("Location: course.php");
        exit();
    } else {
        echo "Payment failed. Please try again.";
    }
} else {
    header("Location: course_fee.html");
    exit();
}
?>
