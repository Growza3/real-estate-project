<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['seller_id'])) {
    header("Location: SignUp.html");
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directory to store uploaded images
    $targetDir = "uploads/";
    $uploadedImages = [];
    $images=$_FILES['images']['name'];
    // Loop through each file in the property_images[] array
    foreach ($_FILES['images']['name'] as $key => $value) {
        $imageFileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $imageFileName;

        // Move the file to the target directory
        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath)) {
            $uploadedImages[] = $imageFileName; // Save the file name in the array
        } else {
            echo "Error uploading " . $imageFileName;
        }
    }

    // Convert array of uploaded images to a comma-separated string
    $imagesString = implode(',', $uploadedImages);

    // Other form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $parking = $_POST['parking'];
    $furnishing_status = $_POST['furnishing_status'];
    $amenities = $_POST['amenities'];
    $nearby_landmarks = $_POST['nearby_landmarks'];

    // Fetch seller_id from session
    $seller_id = $_SESSION['seller_id'];

    // Insert property data into the database
    $stmt = $conn->prepare("INSERT INTO properties (seller_id, images, title, description, location, price, type, size, bedrooms, bathrooms, parking, furnishing_status, amenities, nearby_landmarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("isssssssiiisss", $seller_id, $imagesString, $title, $description, $location, $price, $type, $size, $bedrooms, $bathrooms, $parking, $furnishing_status, $amenities, $nearby_landmarks);
    
    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo "Property added successfully!";
        header("Location: seller_profile.php"); // Redirect to the seller dashboard after success
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

mysqli_close($conn);
?>
