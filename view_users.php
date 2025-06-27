<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "mini_project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all users
$sql = "SELECT user_id, profile, first_name, email, created_at, status FROM users"; // Include status in the query
$result = $conn->query($sql);

// Delete user logic
if (isset($_GET['delete'])) {
    $userId = intval($_GET['delete']);
    $deleteSql = "DELETE FROM users WHERE user_id = $userId"; // Use user_id for deletion
    $conn->query($deleteSql);
    header("Location: view_users.php"); // Refresh the page
    exit();
}

// Block user logic
if (isset($_GET['block'])) {
    $userId = intval($_GET['block']);
    $blockSql = "UPDATE users SET status = 'blocked' WHERE user_id = $userId"; // Block user logic
    $conn->query($blockSql);
    header("Location: view_users.php"); // Refresh the page
    exit();
}

// Unblock user logic
if (isset($_GET['unblock'])) {
    $userId = intval($_GET['unblock']);
    $unblockSql = "UPDATE users SET status = 'active' WHERE user_id = $userId"; // Unblock user logic
    $conn->query($unblockSql);
    header("Location: view_users.php"); // Refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5; /* Light gray background */
            color: #333; /* Darker text for better readability */
        }
        .navbar {
            background-color: #180161; /* Dark blue navbar */
            height: 100px;
            margin: 0;
            width:100%;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important; /* White text */
        }
        .sidebar {
            background-color: #180161; 
            height: 100vh;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            padding-top: 20px;
            margin-top: 100px;
        }
        .sidebar a {
            display: block;
            color: #ffffff; 
            padding: 16px;
            text-decoration: none;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: white;
            color: #180161; 
            border-radius: 20px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            border: none; /* Remove border */
            border-radius: 15px; /* Rounded corners */
            transition: transform 0.2s; /* Smooth transition for hover */
        }
        .card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }
        .card-primary {
            background-color: #4C3BCF; /* Purple card */
            color: #ffffff; /* White text */
        }
        .card-success {
            background-color: #4C3BCF; /* Green for success */
            color: #ffffff; /* White text */
        }
        .card-warning {
            background-color: #4C3BCF; /* Yellow for warnings */
            color: #333; /* Dark text */
        }
        .card-title, .card-text {
            color: #ffffff; /* White text for card content */
        }
        .btn-light {
            background-color: #ffffff; /* White buttons */
            color: #180161; /* Dark blue text */
            border: none;
            border-radius: 20px; /* Rounded buttons */
        }
        .btn-light:hover {
            background-color: #180161; /* Dark blue on hover */
            color: #ffffff; /* White text */
        }
        .card h5,p{
            color: black;
        }
        .card p{
            color: black;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="Admin_Dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="view_users.php"><i class="fas fa-users"></i> Manage Users</a>
        <a href="view_property_admin.php"><i class="fas fa-building"></i> Manage Properties</a>
        <a href="scheduled_meeting_admin.php"><i class="fas fa-calendar-alt"></i> Scheduled Meetings</a>
        <a href="#"><i class="fas fa-envelope"></i> Messages</a>
        <a href="#"><i class="fas fa-cogs"></i> Settings</a>
    </div>
    <div class="content">
        <div class="container">
            <h1 class="mt-4">All Registered Users</h1>

            <h2 class="mt-4">Blocked Users</h2>
            <div class="row">
                <?php
                // Query to fetch blocked users
                $blockedSql = "SELECT user_id, profile, first_name, email, created_at FROM users WHERE status = 'blocked'";
                $blockedResult = $conn->query($blockedSql);

                if ($blockedResult->num_rows > 0):
                    while ($row = $blockedResult->fetch_assoc()): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="uploads/<?php echo htmlspecialchars($row['profile']); ?>" alt="User Image" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['first_name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['email']); ?></p>
                                    <p class="card-text"><small class="text-muted">Blocked on: <?php echo htmlspecialchars($row['created_at']); ?></small></p>
                                    <a href="?delete=<?php echo $row['user_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</a>
                                    <a href="?unblock=<?php echo $row['user_id']; ?>" class="btn btn-success">Unblock User</a> <!-- Unblock button -->
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center">No blocked users found</div>
                    </div>
                <?php endif; ?>
            </div>

            <h2 class="mt-4">Active Users</h2>
            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php if ($row['status'] !== 'blocked'): // Display only active users ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="uploads/<?php echo htmlspecialchars($row['profile']); ?>" alt="User Image" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['first_name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($row['email']); ?></p>
                                        <p class="card-text"><small class="text-muted">Registered on: <?php echo htmlspecialchars($row['created_at']); ?></small></p>
                                        <a href="?delete=<?php echo $row['user_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</a>
                                        <a href="?block=<?php echo $row['user_id']; ?>" class="btn btn-warning">Block User</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center">No users found</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
