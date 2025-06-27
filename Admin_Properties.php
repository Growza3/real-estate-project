<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all properties
$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Properties</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <style>
        header {
            background-color: #fff;
            color: #ffffff;
            padding: 15px 0;
            text-align: center;
        }
        a {
            font-family: 'Times New Roman', Times, serif;
            font-size: 32px;
            text-decoration: none;
            color: black;
            margin-inline: 20px;
        }
        a:hover{
            color: white;
            background-color: black;
            font-size: 32px;
            text-decoration: none;
            border-radius: 10px;
            padding: 10px;
        }
        .button{
            font-size: 20px;
            color:white;
            background-color: black;
            padding: 8px;
            border-radius: 10px;
        }
        .property-card {
            margin-bottom: 30px;
        }
        .carousel-inner img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<header>
    <div class="d-flex align-items-center justify-content-between p-3">
      <img data-aos="zoom-in" src="Empire2.png" alt="logo" height="150" width="150"/>
      <div data-aos="fade-up">
        <a href="Admin_Dashboard.php">Admin Dashboard</a>
      </div>
    </div>
</header>

<div class="container mt-5">
    <h2>Property Management</h2>
    
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4">
            <div class="card property-card">
                <div id="carousel-<?php echo $row['property_id']; ?>" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $row['front_img']; ?>" alt="Front Image">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $row['living_img']; ?>" alt="Living Room Image">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $row['bedroom_img']; ?>" alt="Bedroom Image">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $row['bathroom_img']; ?>" alt="Bathroom Image">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $row['kitchen_img']; ?>" alt="Kitchen Image">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $row['property_id']; ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $row['property_id']; ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text">
                        <strong>Location:</strong> <?php echo $row['location']; ?><br>
                        <strong>Price:</strong> <?php echo $row['price']; ?><br>
                        <strong>Type:</strong> <?php echo $row['type']; ?><br>
                        <strong>Size:</strong> <?php echo $row['size']; ?><br>
                        <strong>Bedrooms:</strong> <?php echo $row['bedrooms']; ?><br>
                        <strong>Bathrooms:</strong> <?php echo $row['bathrooms']; ?><br>
                        <strong>Balconies:</strong> <?php echo $row['balconies']; ?><br>
                        <strong>Parking:</strong> <?php echo $row['parking']; ?><br>
                        <strong>Furnishing Status:</strong> <?php echo $row['furnishing_status']; ?><br>
                        <strong>Facing Direction:</strong> <?php echo $row['direction']; ?><br>
                        <strong>Availability:</strong> <?php echo $row['availability_status']; ?>
                    </p>
                    <a href="edit_property.php?title=<?php echo urlencode($row['title']); ?>" class="btn btn-primary">Edit</a>
                    <a href="delete_property.php?id=<?php echo $row['title']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>

   
    