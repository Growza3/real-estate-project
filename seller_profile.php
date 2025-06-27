<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['seller_id'])) {
    echo "<script>alert('Please Log-In First!'); window.location.href='signup1.php';</script>";
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get seller_id from session
$seller_id = $_SESSION['seller_id'];

// Fetch properties added by this seller
$sql = "SELECT * FROM properties WHERE seller_id = '$seller_id'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        html, body {
            margin: 0;
            padding: 0;
            background-image: url('build5.jpg');
            background-size: cover;
            background-position: center;
            height: 1300px;
            width: 100%;
            font-family: 'Times New Roman', Times, serif;
        }
        .container {
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(228, 224, 225, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2, h3, h4, p {
            color: #343a40;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            height: 100px;
            background-color: #493628;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        header img {
    height: 150px;
    margin:0;
    padding: 0;
}

.d-flex a{
  color: white;
  text-decoration: none;
  margin-inline: 10px;
  font-size: 26px;
}
.d-flex a:first-child{
  margin-left: 450px;
}
        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #493628;
        }
        .card-property {
            margin-bottom: 20px;
        }
        .card-property:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .card-property img {
            height: 200px;
            object-fit: cover;
        }
        .btn-nav {
            background-color: #493628;
            color: white;
            border-radius: 15px;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 30px;
            margin-top: 10px;
            display: block;
        }
        .btn-nav:hover {
            background-color: burlywood;
        }
        .footer {
  background: #493628; /* Gradient background */
  padding: 40px 70px;
  color: #fff;
  position: relative; /* Allows for positioning of pseudo-elements */
  overflow: hidden; /* To ensure no overflow from pseudo-elements */
}

.footer h5 {
  font-size: 24px; /* Increased font size */
  margin-bottom: 20px;
  font-weight: bold; /* Bold headings */
  border-bottom: 2px solid #ffa500; /* Underline for headings */
  padding-bottom: 10px; /* Space between heading and text */
  color:white;
}

.footer p {
  font-size: 16px; /* Slightly smaller font size */
  line-height: 1.5;
  color: white;
}

.footer ul {
  list-style: none;
  padding: 0;
}

.footer ul li {
  margin-bottom: 10px;
}

.footer ul li a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer ul li a:hover {
  color: #ffa500; /* Change to gold on hover */
}

.footer .d-flex a {
  font-size: 28px; /* Increased font size for social icons */
  color: #fff;
  margin-right: 15px;
  transition: transform 0.3s ease, color 0.3s ease;
}

.footer .d-flex a:hover {
  color: #ffa500; /* Change color on hover */
  transform: scale(1.1); /* Scale effect on hover */
}

.footer .text-center p {
  margin-top: 20px;
  font-size: 14px;
  color: #ccc;
}

/* Bottom border for a subtle separation */
.bottom-footer {
  border-top: 2px solid #ffa500; /* Light border for separation */
  padding-top: 20px;
  
}
.card-title {
        font-size: 1.5rem; /* Title font size */
        color: #16325B; /* Darker color for title */
    }

    .card-text {
        color: #16325B; /* Lighter color for text */
        font-size: 1rem; /* Normal font size */
    }
.card-body{
    padding: 20px;
    height: auto;
    border: 1px solid #493628;
}
.profile-details h4{
    font-size: 30px;
}
.profile-details p{
    font-size: 24px;
}
.text-center h2{
    font-size: 34px;
}
    </style>
</head>
<header >
    <div class="d-flex align-items-center justify-content-between p-3">
      <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
      <div data-aos="fade-up"> 
        <a href="Home.php">Home</a> 
        <a href="#">Contact Us</a>
        <a href="#">About Us</a>
      </div>
      <div data-aos="fade-up">
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>

<div class="container">
    <div class="text-center">
        <div class="profile-header">
            <img src="<?php echo $_SESSION['profile']; ?>" alt="Profile Photo">
        </div>
        <h2 class="mt-3">Welcome, <?php echo $_SESSION['email']; ?>!</h2>
    </div>


        <div class="row mt-4">
            <div class="col-md-6 profile-details">
                <h4>Your Profile Details</h4>
                <p><i class="fas fa-user"></i> Name: <?php echo $_SESSION['first_name']; ?></p>
                <p><i class="fas fa-envelope"></i> Email: <?php echo $_SESSION['email']; ?></p>
            </div>
        </div>

        <!-- Navigation to other pages -->
        <div class="mt-4 text-center">
            <h3>Explore More</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Add Properties</h5>
                            <a href="add_property.html" class="btn-nav">
                                <i class="fas fa-heart"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Scheduled Meetings</h5>
                            <a href="scheduled_meeting_seller.php" class="btn-nav">
                                <i class="fas fa-calendar-alt"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Edit Profile</h5>
                            <a href="edit_profile.php" class="btn-nav">
                                <i class="fas fa-building"></i> View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    <div class="mt-5">
        <h3>Your Properties</h3>
        <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php 
            $images = explode(',', $row['images']); // Split the images string into an array
        ?>
        <div class="col-md-4">
            <div class="card card-property">
                <!-- Bootstrap Carousel for multiple images -->
                <div id="carousel-<?php echo $row['property_id']; ?>" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="uploads/<?php echo $image; ?>" class="d-block w-100" alt="Property Image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Carousel controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $row['property_id']; ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $row['property_id']; ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Property details -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p><strong>Price:</strong> ₹<?php echo $row['price']; ?></p>
                    <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                    <a href="edit_property.php?property_id=<?php echo $row['property_id']; ?>" class="btn-nav">Edit</a>
                    <a href="delete_property.php?property_id=<?php echo $row['property_id']; ?>" class="btn-nav">Delete</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No properties found.</p>
<?php endif; ?>

        </div>
    </div>
</div>
</div>

<footer class="footer">
  <div class="more">
    <div class="row">
      <!-- Contact Info -->
      <div class="col-md-4">
        <h5>Contact Us</h5>
        <p>
          Regel Realty<br>
          123 Main St, Mumbai, India<br>
          Email: info@regelrealty.com<br>
          Phone: +91-985472156
        </p>
      </div>
      
      <!-- Property Insights -->
      <div class="col-md-4">
        <h5>Property Insights</h5>
        <p>"Did you know? Investing in real estate has consistently outperformed stocks over the last 50 years!"</p>
        <p>Tip: "Always consider the neighborhood’s potential growth when buying a property."</p>
        <p>Fact: "In most countries, properties appreciate around 3-5% annually."</p>
      </div>

      <!-- Social Media -->
      <div class="col-md-4">
        <h5>Follow Us</h5>
        <a href="#" class="text-light me-3">
          <i class="fa fa-facebook"></i>
        </a>
        <a href="#" class="text-light me-3">
          <i class="fa fa-twitter"></i>
        </a>
        <a href="#" class="text-light me-3">
          <i class="fa fa-instagram"></i>
        </a>
        <a href="#" class="text-light">
          <i class="fa fa-linkedin"></i>
        </a>
      </div>
    </div>

    <!-- Bottom Footer -->
    <div class="bottom-footer text-center mt-4">
      <p>© 2024 Empire Properties. All Rights Reserved.</p>
    </div>
  </div>
</footer>


</body>
</html>
