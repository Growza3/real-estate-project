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

// Fetch current user data
$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}

// Handle profile update
if (isset($_POST['update_profile'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $profile_photo = $user['profile']; // default current photo

    // Handle profile photo upload
    if (!empty($_FILES['profile']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['profile']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate the uploaded file
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $valid_extensions)) {
            if (move_uploaded_file($_FILES['profile']['tmp_name'], $target_file)) {
                $profile_photo = $target_file; // Update to new profile photo path
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type.";
        }
    }

    // Update user details in the database
    $update_query = "UPDATE buyers SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number', profile = '$profile_photo' WHERE email = '$email'";

    if (mysqli_query($conn, $update_query)) {
        // Update session variables to reflect the changes
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['phone_number'] = $phone_number;
        $_SESSION['profile'] = $profile_photo;

        // Redirect back to profile page after successful update
        header("Location: buyer_profile.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #f4f4f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
      max-width: 700px;
      margin-top: 50px;
      padding: 30px;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      font-weight: bold;
      margin-bottom: 30px;
      color: #333;
    }

    .profile-photo img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .profile-photo img:hover {
      transform: scale(1.1);
    }

    .form-label {
      font-weight: 500;
      color: #555;
    }

    .form-control {
      background-color: #f9f9fb;
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      box-shadow: none;
      transition: border-color 0.3s;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .profile-photo-label {
      display: inline-block;
      margin-bottom: 10px;
      color: #666;
    }

    .mb-3 {
      position: relative;
    }

    .mb-3 input[type="file"] {
      opacity: 0;
      position: absolute;
      z-index: 1;
      top: 0;
      left: 0;
      cursor: pointer;
      width: 100%;
      height: 100%;
    }

    .profile-photo-label {
      color: #555;
      font-weight: bold;
      margin-top: 15px;
    }

    .upload-btn {
      border: 2px dashed #007bff;
      border-radius: 10px;
      text-align: center;
      padding: 10px;
      color: #007bff;
      font-weight: bold;
      transition: background-color 0.3s, color 0.3s;
    }

    .upload-btn:hover {
      background-color: #007bff;
      color: #fff;
    }

    .shadow-custom {
      box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }
  </style>
</head>

<body>
  <div class="container shadow-custom">
    <h2 class="text-center">Edit Your Profile</h2>
    <form action="edit_profile.php" method="POST" enctype="multipart/form-data">

      <div class="profile-photo text-center mb-4">
        <img src="<?php echo $user['profile']; ?>" alt="Current Profile Photo">
        <div class="profile-photo-label mt-2">Current Profile Photo</div>
      </div>

      <div class="mb-3 text-center">
        <label for="profile" class="upload-btn">
          <i class="bi bi-upload"></i> Click to upload new photo
        </label>
        <input type="file" id="profile" name="profile" accept="image/*">
      </div>

      <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="phone_number" class="form-label">Contact Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $user['phone_number']; ?>" required>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary px-5" name="update_profile">Update Profile</button>
      </div>
    </form>
  </div>

  <!-- Icons -->
  <script src="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
