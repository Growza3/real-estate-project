<?php
session_start();

// Check if seller is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['seller_id'])) {
    header("Location: SignUp.html");
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if property_id is provided
if (!isset($_GET['property_id'])) {
    echo "Property not found!";
    exit();
}

$property_id = $_GET['property_id'];

// Delete property query
$sql = "DELETE FROM properties WHERE property_id = '$property_id' AND seller_id = '{$_SESSION['seller_id']}'";

if (mysqli_query($conn, $sql)) {
    header("Location: seller_profile.php?success=Property deleted successfully");
} else {
    echo "Error deleting property: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
    