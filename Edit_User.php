<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "empire");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the email is set in the URL parameter
if (isset($_GET['id'])) {
    $email = mysqli_real_escape_string($conn, $_GET['id']); // Get email from the URL
    $sql = "SELECT * FROM signup WHERE email='$email'"; // Adjust the table name if needed
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "No user email specified!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['nm']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['con']);
    
    // Update user in the database
    $update_sql = "UPDATE signup SET nm='$name', con='$contact_no' WHERE email='$email'"; // Use the retrieved email
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('User updated successfully!'); window.location.href='All_Users.php';</script>";
    } else {
        echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">Real Estate Admin</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_property.html">Add Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_management.php">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Edit User Form -->
    <div class="container">
        <h2>Edit User</h2>
        <form action="edit_user.php?id=<?php echo urlencode($email); ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="nm" value="<?php echo htmlspecialchars($user['nm']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required readonly>
            </div>
            <div class="mb-3">
                <label for="contact_no" class="form-label">Contact No:</label>
                <input type="text" class="form-control" id="contact_no" name="con" value="<?php echo htmlspecialchars($user['con']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</body>
</html>
