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

        // SQL query to fetch meetings
        $sql_meetings = "SELECT 
                            appointments.appointment_id,
                            users.first_name AS buyer_name,
                            users.first_name AS seller_name,
                            appointments.appointment_date,
                            appointments.appointment_time,
                            appointments.msg
                        FROM 
                            appointments
                        JOIN 
                            buyers ON appointments.buyer_id = buyers.buyer_id
                        JOIN 
                            sellers ON appointments.seller_id = sellers.seller_id
                        JOIN 
                            users ON sellers.seller_id = users.user_id
                        ORDER BY 
                            appointments.appointment_date, appointments.appointment_time";

        $result_meetings = $conn->query($sql_meetings);
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
    <div class="content">
    <div class="container mt-5">
       <?php
        // Check if query was successful
        if ($result_meetings === false) {
            die("Error: " . $conn->error);
        }

        // Display results in tabular format
        if ($result_meetings->num_rows > 0) {
            echo '<h2>Scheduled Meetings</h2>';
            echo '<table class="table table-striped" border="2px solid black">';
            echo '<thead><tr><th>Meeting ID</th><th>Buyer Name</th><th>Seller Name</th><th>Date</th><th>Time</th><th>Agenda</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result_meetings->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['appointment_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['buyer_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['seller_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['appointment_date']) . '</td>';
                echo '<td>' . htmlspecialchars($row['appointment_time']) . '</td>';
                echo '<td>' . htmlspecialchars($row['msg']) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No scheduled meetings found.</p>';
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
