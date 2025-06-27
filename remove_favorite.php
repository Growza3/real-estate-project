<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: SignUp.html");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the favorite ID to remove
if (isset($_GET['favorite_id'])) {
    $favorite_id = $_GET['favorite_id'];
    
    // Remove from favorites table using the favorite_id
    $delete_sql = "DELETE FROM favorites WHERE favorite_id='$favorite_id'"; // Correctly using the id field

    if (mysqli_query($conn, $delete_sql)) {
        // Successfully removed
        echo "<script>alert('Property removed from favorites!'); window.location.href='buyer_profile.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request!";
}
?>
