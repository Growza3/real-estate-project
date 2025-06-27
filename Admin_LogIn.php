<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "empire");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = "admin";
    $pass = "admin123";

    // Query to check if the username and password match
    $sql = "SELECT * FROM admin WHERE uname='$uname' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User exists, set session variables
        $_SESSION['admin'] = $uname; // Store username in session
        header("Location: Admin_Dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href='admin_login.html';</script>";
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
