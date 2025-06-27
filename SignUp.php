<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $profile = $_FILES['profile']['name'];
    $profile_temp = $_FILES['profile']['tmp_name'];
    $target_dir = "uploads/";

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='SignUp.html';</script>";
        exit();
    }

    if (!move_uploaded_file($profile_temp, $target_dir . $profile)) {
        echo "<script>alert('File upload failed for profile image.'); window.location.href='SignUp.html';</script>";
        exit();
    }

    // Inserting into users table
    $sql = "INSERT INTO users (profile, first_name, last_name, phone_number, role, email, password, created_at, updated_at) VALUES ('$profile', '$first_name', '$last_name', '$phone_number', '$role', '$email', '$password', NOW(), NOW())";
    if (mysqli_query($conn, $sql)) {
        $user_id = mysqli_insert_id($conn); // Get the last inserted user ID

        // Insert into the appropriate role table
        if ($role === 'buyer') {
            $buyer_sql = "INSERT INTO buyers (user_id, name, email, phone) VALUES ('$user_id', '$first_name', '$email', '$phone_number')";
            mysqli_query($conn, $buyer_sql);
        } elseif ($role === 'seller') {
            $seller_sql = "INSERT INTO sellers (user_id, name, email, phone) VALUES ('$user_id', '$first_name', '$email', '$phone_number')";
            mysqli_query($conn, $seller_sql);
        }

        echo "<script>alert('SignUp Successful! Please Sign In.'); window.location.href='SignUp.html';</script>";
    } else {
        echo "<script>alert('Error during registration.'); window.location.href='SignUp.html';</script>";
    }
}
?>
