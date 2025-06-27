<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: SignUp.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="mt-4">Agent Profile</h2>
    <p><strong>Name:</strong> <?php echo $_SESSION['nm']; ?></p>
    <p><strong>Contact No:</strong> <?php echo $_SESSION['con']; ?></p>
    <p><strong>Image:</strong></p>
    <!-- Display the image using an <img> tag -->
    <img src="uploads/<?php echo $_SESSION['image']; ?>" alt="Profile Image" width="150" height="150">
    <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
</body>
</html>
