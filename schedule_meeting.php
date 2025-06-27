<?php
session_start();
if (!isset($_SESSION['email']) && !isset($_POST['password'])) {
    echo "<script>alert('Please Login First!');
    window.location.href='SignUp.html';</script>";
    exit();
}

// Get property_id and seller_id from URL
$property_id = $_GET['property_id'];
$seller_id = $_GET['seller_id'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $msg = $_POST['msg']; // Capture the message from the buyer
    $buyer_id = $_SESSION['buyer_id']; // Assuming buyer_id is stored in session

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "mini_project");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (property_id, buyer_id, seller_id, appointment_date, appointment_time, msg, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Setting status as 'scheduled'
    $status = 'scheduled';

    // Bind parameters
    $stmt->bind_param("iiissss", $property_id, $buyer_id, $seller_id, $appointment_date, $appointment_time, $msg, $status);

    if ($stmt->execute()) {
        // Fetch the last inserted appointment ID to display all details
        $appointment_id = $stmt->insert_id; // Get the ID of the newly created appointment

        // Create the popup message with all details
        $popupMessage = "Meeting Scheduled Successfully!\\n";
        $popupMessage .= "Appointment ID: $appointment_id\\n";
        $popupMessage .= "Date: $appointment_date\\n";
        $popupMessage .= "Time: $appointment_time\\n";
        $popupMessage .= "Your Message: $msg";

        // Display the confirmation with all meeting details in a popup
        echo "<script>
                alert('$popupMessage');
                window.location.href = 'buyer_profile.php?meeting=success';
              </script>";
    } else {
        // Provide detailed error information
        echo "Error scheduling the meeting: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Meeting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Schedule Meeting for Property</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="appointment_date" class="form-label">Select Date:</label>
            <input type="date" class="form-control" name="appointment_date" required>
        </div>
        <div class="mb-3">
            <label for="appointment_time" class="form-label">Select Time:</label>
            <input type="time" class="form-control" name="appointment_time" required>
        </div>
        <div class="mb-3">
            <label for="buyer_message" class="form-label">Message to Seller:</label>
            <textarea class="form-control" name="msg" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Schedule Meeting</button>
    </form>
</div>
</body>
</html>
