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

// Fetch properties from the database
$sql = "SELECT property_id, title, images, description FROM properties";
$result = $conn->query($sql);
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
        .carousel-item img {
            height: 300px; /* Adjust the height as needed */
            object-fit: cover; /* Cover the area */
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

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Welcome, Admin</h1>
            <p class="lead">Here is an overview of your administrative activities.</p>

            <!-- Dashboard Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users"></i> Users</h5>
                            <p class="card-text">Manage all users registered on the platform.</p>
                            <a href="view_users.php" class="btn btn-light">View Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-building"></i> Properties</h5>
                            <p class="card-text">View and manage properties listed by sellers.</p>
                            <a href="view_property_admin.php" class="btn btn-light">View Properties</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-warning">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-envelope"></i> Messages</h5>
                            <p class="card-text">Check messages from users and sellers.</p>
                            <a href="#" class="btn btn-light">View Messages</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-warning">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-alt"></i> Meeting Detail</h5>
                            <p class="card-text">Check meetings scheduled between users and sellers.</p>
                            <a href="scheduled_meeting_admin.php" class="btn btn-light">View Meeting</a>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
