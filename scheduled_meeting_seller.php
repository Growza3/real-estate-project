<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['seller_id'])) {
    echo "<script>alert('Please Log-In First!'); window.location.href='signup1.php';</script>";
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$seller_id = $_SESSION['seller_id']; // Assuming seller_id is stored in session

// Fetch scheduled meetings for the seller with buyer details
$meeting_query = "
    SELECT 
        appointments.appointment_date, 
        appointments.appointment_id,
        appointments.appointment_time, 
        users.first_name AS buyer_name, 
        users.profile AS buyer_image, 
        appointments.status 
    FROM appointments  
    JOIN buyers ON appointments.buyer_id = buyers.buyer_id 
    JOIN users ON buyers.user_id = users.user_id 
    WHERE appointments.seller_id = '$seller_id'
";
$meeting_result = mysqli_query($conn, $meeting_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Meetings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
            transition: transform 0.3s;
            border: none;
            border-radius: 0.5rem; /* Make the corners slightly rounded */
            background-color: #FFF1DB;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .buyer-image {
           
            max-width: 400px; /* Adjusted size for the top */
            max-height: 300px;
            margin: 0 auto; /* Centering the image */
            display: block; /* Ensuring it is block element */
            border-radius: 10px;
            border: 1px solid #493628;
        }
        .card-header {
            text-align: center; /* Center header text */
        }
        .fade-in {
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        html, body {
            margin: 0;
            padding: 0;
            background-image: url('build5.jpg');
            background-size: cover;
            background-position: center;
            height: 1000px;
            width: 100%;
            font-family: 'Times New Roman', Times, serif;
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
.btn-nav {
            background-color: #493628;
            color: white;
            border-radius: 15px;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 30px;
            margin-top: 10px;
            display: block;
            width: 100%;
        }
        .btn-nav:hover {
            background-color: burlywood;
        }
.d-flex a{
  color: white;
  text-decoration: none;
  margin-inline: 10px;
  font-size: 26px;
}
.d-flex a:first-child{
  margin-left: 400px;
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
.container h1{
    color: white;
    background-color: #493628;
    padding: 20px;
    border-radius: 20px;
}
    </style>
</head>
<body>
<header >
        <div class="d-flex align-items-center justify-content-between p-3">
          <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
          <div data-aos="fade-up"> 
            <a href="Home.php">Home</a> 
            <a href="#">Contact Us</a>
            <a href="#">About Us</a>
          </div>
          <div data-aos="fade-up">
            <a href="seller_profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </header>
<div class="container mt-5 fade-in">
    <center><h1 class="mb-12">Your Scheduled Meetings</h1></center>
    <div class="row">
        <?php while ($meeting = mysqli_fetch_assoc($meeting_result)): ?>
        <div class="col-md-4">
            <div class="card text-center"> <!-- Added text-center for center alignment -->
                <img src="uploads/<?php echo htmlspecialchars($meeting['buyer_image']); ?>" alt="Buyer Image" class="buyer-image mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($meeting['buyer_name']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($meeting['appointment_date']); ?> at <?php echo htmlspecialchars($meeting['appointment_time']); ?></h6>
                    <p class="card-text">Status: <strong><?php echo htmlspecialchars($meeting['status']); ?></strong></p>
                    <a href="edit_appointment_status.php?appointment_id=<?php echo htmlspecialchars($meeting['appointment_id']); ?>" class="btn-nav">Edit Status</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Add a fade-in effect for the cards
        $('.fade-in').hide().fadeIn(1000);
    });
</script>
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
