<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "empire");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['email'])) {
    // Debugging line
    echo "Email received: " . htmlspecialchars($_GET['email']);
    // Remove exit(); to allow code to continue
    // exit(); // Uncomment this line only for debugging purposes

    // Retrieve email directly as a string
    $email = mysqli_real_escape_string($conn, $_GET['email']); // Sanitize the input

    // SQL to delete the user
    $sql = "DELETE FROM signup WHERE email = '$email'"; // Use single quotes for the string in SQL

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User deleted successfully!'); window.location.href='All_Users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "'); window.location.href='All_Users.php';</script>";
    }
} else {
    echo "<script>alert('No user ID specified!'); window.location.href='All_Users.php';</script>";
}

mysqli_close($conn);
