<?php
// Start session
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buyer Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;  
    }
    
    .profile-container {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 50px auto;
        height: 800px;
    }
    
    .profile-header {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 30px;
    }

    .profile-header img {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .profile-container h2{
        font-size: 50px;
        font-weight: 600;
        margin: 0;
        font-family: 'Times New Roman', Times, serif;
    }
    .profile-details p {
        font-size: 24px;
        margin: 8px 0;
        font-family: 'Times New Roman', Times, serif;
    }
    
    .profile-details p strong {
        color: #333;
    }

    .edit-btn {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .profile-header img {
            width: 120px;
            height: 120px;
        }
    }
</style>
<body>
<div class="container">
    <div class="profile-container">
        <h2 class="mt-4">Buyer Profile</h2><br/>
        <div class="profile-header">
            <img src="<?php echo $_SESSION['profile']; ?>" alt="Profile Photo">
        </div>
        <div class="profile-details">
            <p><strong>First Name:</strong> <?php echo $_SESSION['first_name']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $_SESSION['last_name']; ?></p>
            <p><strong>Contact No:</strong> <?php echo $_SESSION['phone_number']; ?></p>
            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        </div>
        <!-- Edit Profile Button -->
        <div class="edit-btn">
            <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>

</body>
</html>
