<?php
session_start();
if (!isset($_SESSION['seller_id'])) {
    header("Location: SignUp.html");
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get appointment_id from the URL
$appointment_id = $_GET['appointment_id'];

// Fetch the current status of the appointment
$sql = "SELECT status FROM appointments WHERE appointment_id = '$appointment_id'";
$result = mysqli_query($conn, $sql);
$appointment = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_status = $_POST['status'];
    
    // Update the appointment status in the database
    $update_sql = "UPDATE appointments SET status = '$new_status' WHERE appointment_id = '$appointment_id'";
    if (mysqli_query($conn, $update_sql)) {
        // Redirect to the seller profile page after successful update
        header("Location: seller_profile.php");
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Appointment Status</h2>
    
    <!-- Form to Update Status -->
    <form method="POST">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="scheduled" name="scheduled" <?php if ($appointment['status'] == 'scheduled') echo 'selected'; ?>>Scheduled</option>
                <option value="completed" name="completed" <?php if ($appointment['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                <option value="canceled" name="canceled" <?php if ($appointment['status'] == 'canceled') echo 'selected'; ?>>Canceled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
</body>
</html>
