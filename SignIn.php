<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch user details from the 'users' table
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set common session variables
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['phone_number'] = $row['phone_number'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['profile'] = $row['profile'];
        $_SESSION['user_id'] = $row['user_id']; // Store the user ID for reference

        // Regardless of the role, fetch both buyer_id and seller_id (if available)
        // Fetch buyer_id from the 'buyers' table based on user_id
        $buyer_sql = "SELECT buyer_id FROM buyers WHERE user_id = '{$row['user_id']}'";
        $buyer_result = mysqli_query($conn, $buyer_sql);
        if (mysqli_num_rows($buyer_result) > 0) {
            $buyer_row = mysqli_fetch_assoc($buyer_result);
            $_SESSION['buyer_id'] = $buyer_row['buyer_id']; // Set session for buyer_id
        } else {
            $_SESSION['buyer_id'] = null; // No buyer_id found
        }

        // Fetch seller_id from the 'sellers' table based on user_id
        $seller_sql = "SELECT seller_id FROM sellers WHERE user_id = '{$row['user_id']}'";
        $seller_result = mysqli_query($conn, $seller_sql);
        if (mysqli_num_rows($seller_result) > 0) {
            $seller_row = mysqli_fetch_assoc($seller_result);
            $_SESSION['seller_id'] = $seller_row['seller_id']; // Set session for seller_id
        } else {
            $_SESSION['seller_id'] = null; // No seller_id found
        }

        // Now, redirect based on the user's primary role
        if ($row['role'] == 'buyer') {
            echo "<script>window.location.href='buyer_profile.php';</script>";
        } elseif ($row['role'] == 'seller') {
            echo "<script>window.location.href='seller_profile.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email or invalid password.'); window.location.href='signup1.php';</script>";
    }
}
?>
