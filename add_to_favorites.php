<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_POST['password'])) {
    echo "<script>alert('Please Login First!');
    window.location.href='SignUp.html';</script>";
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the property ID and user email
if (isset($_GET['property_id'])) {
    $property_id = $_GET['property_id'];
    $buyer_id = $_SESSION['buyer_id'];

    // Check if the property is already added to favorites for the user
    $check_sql = "SELECT * FROM favorites WHERE buyer_id='$buyer_id' AND property_id='$property_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Property already in favorites
        echo "<script>alert('This property is already in your favorites!');
        window.location.href='buyer_profile.php';</script>";
    } else {
        // Insert into favorites table
        $sql = "INSERT INTO favorites (buyer_id, property_id) VALUES ('$buyer_id', '$property_id')";

        if (mysqli_query($conn, $sql)) {
            // Successfully added
            echo "<script>alert('Property added to favorites!');
            window.location.href='buyer_profile.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid request!";
}
?>
