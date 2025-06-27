<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: SignUp.html");
    exit();
}

$buyer_id = $_SESSION['buyer_id'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch scheduled meetings for the buyer with seller details
$meeting_query = "
    SELECT 
        appointments.appointment_date, 
        appointments.appointment_time, 
        users.first_name AS seller_name, 
        users.profile AS seller_image, 
        appointments.status 
    FROM appointments  
    JOIN sellers ON appointments.seller_id = sellers.seller_id 
    JOIN users ON sellers.user_id = users.user_id 
    WHERE appointments.buyer_id = '$buyer_id'";

$meeting_result = mysqli_query($conn, $meeting_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Meetings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
                html, body {
  margin: 0;
  padding: 0;
  position: relative; /* Needed to overlay the dark background */
  background-image: url('b1.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  width: 100%;
  height: 100%;
  font-family: 'Times New Roman', Times, serif;
}
        /* Elegant Footer Styles */
        .footer {
  background: #16325B; /* Gradient background */
  padding: 40px 0;
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
}

.footer p {
  font-size: 16px; /* Slightly smaller font size */
  line-height: 1.5;
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
.detail{
  color:red;
  text-decoration:none;
  font-size:20px;
}
        /* Additional Styling */
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }

        

        /* Card Styles */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .card-title {
            color: #333;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .card-text {
            color: #555;
            font-size: 1rem;
        }

        

        /* Additional Effects */
        .container {
            margin-top: 50px;
            padding-bottom: 50px;
        }
        h2 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 40px;
        }
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
       
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        header {
    margin: 0;
    padding: 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100px; /* Reduced header height */
    color: #fff; /* Text color */
    padding: 0 30px; /* Side padding */
    background-color: #16325B; /* Dark background for header */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
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
  font-size: 22px;
}
.d-flex a:first-child{
  margin-left: 400px;
}
    </style>
</head>
<body>

<header >
    <div class="d-flex align-items-center justify-content-between p-3">
      <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
      <div data-aos="fade-up"> 
        <a href="Home.html">Home</a> 
        <a href="seller_profile.php">Sell</a>
        <a href="#">Contact Us</a>
        <a href="#">About Us</a>
      </div>
      <div data-aos="fade-up">
        <a href="buyer_profile.php">My Profile</a>
        <a href="Admin_LogIn.html">Admin</a>
      </div>
    </div>
  </header>

<div class="container fade-in">
    <h2 style="font-family:'Times New Roman', Times, serif;  color: white; background-color: #16325B; font-size:60px">Scheduled Meetings</h2>
    <div class="row">
        <?php
        if (mysqli_num_rows($meeting_result) > 0) {
            while ($meeting = mysqli_fetch_assoc($meeting_result)) {
                echo "<div class='col-md-4'>
                        <div class='card'>
                            <img src='uploads/{$meeting['seller_image']}' class='card-img-top' alt='Seller Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>Meeting with {$meeting['seller_name']}</h5>
                                <p class='card-text'>Date: {$meeting['appointment_date']}</p>
                                <p class='card-text'>Time: {$meeting['appointment_time']}</p>
                                <p class='card-text'>Status: {$meeting['status']}</p>
                            </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p class='text-center'>No scheduled meetings found.</p>";
        }
        ?>
    </div>
</div>

<footer class="footer">
  <div class="container">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
