<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_POST['password']) ) {
    header("Location: SignUp.html");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure buyer_id is set in the session (you should set it when the user logs in)
if (!isset($_SESSION['buyer_id'])) {
    echo "Buyer ID not found in session.".var_dump($_SESSION);
    exit();
}

// Fetch properties from the property table
$sql = "
    SELECT properties.*, favorites.favorite_id 
    FROM properties 
    LEFT JOIN favorites ON properties.property_id = favorites.property_id AND favorites.buyer_id = '{$_SESSION['buyer_id']}'
";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buyer Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
/* Add an overlay effect */
html::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4); /* Black overlay with 50% opacity */
  z-index: 1; /* Ensures it's above the background image but below content */
  border-radius: 10px;
}

/* Ensure all other elements appear above the overlay */
body * {
  position: relative;
  z-index: 2; /* Content will be above the dark overlay */
}
    /* Header Styles */
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
  font-size: 26px;
}
.d-flex a:first-child{
  margin-left: 390px;
}
.footer {
  background: #16325B; /* Gradient background */
  padding: 40px 0;
  color: #fff;
  position: relative; /* Allows for positioning of pseudo-elements */
  overflow: hidden; /* To ensure no overflow from pseudo-elements */
  flex-shrink: 0;
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
img {
  border-radius: 10px;
  margin: 0;
  padding: 0;
}
    /* Footer Styles */
    .footer {
      background-color: #343a40; /* Dark footer background */
      color: white;
      text-align: center;
      padding: 20px 0;
      position: relative;
      bottom: 0;
      width: 100%;
      margin-top: 20px;
      box-shadow: 3px 5px 5px black;
      background: linear-gradient(to right, #001F54, #00508B);
       padding: 40px 0;
    }
    .footer p {
        
      margin: 0;
      font-family: 'Times New Roman', Times, serif;
    }
    .footer .social-icons a {
      color: white;
      margin: 0 10px; /* Space between icons */
      transition: color 0.3s; /* Transition for social icons */
    }
    .footer .social-icons a:hover {
      color: #ffd700; /* Gold color on hover */
      box-shadow: 3px 5px 5px black;
    }
        h3 {
      font-family: 'Times New Roman', Times, serif;
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
      font-size: 2.5em;
      font-weight: bold;
      text-transform: uppercase;
      color:#FAECE2; /* Match button colors */
    }
    .card {
      border: none; /* Remove default card border */
      border-radius: 15px; /* Rounded corners */
      overflow: hidden; /* Ensure child elements are clipped */
      transition: transform 0.2s; /* Animation effect */
    }
    .card:hover {
      transform: scale(1.05); /* Slightly enlarge card on hover */
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Shadow effect */
    }
    .carousel-inner img {
      border-radius: 15px 15px 0 0; /* Rounded top corners for images */
    }
    
    .btn-schedule {
        width: 100%; /* Make buttons full width */
      margin-top: 10px; /* Space between buttons */
      font-size: 20px; /* Adjust font size */
      color: white;
      border-radius: 15px; /* Rounded button corners */
      transition: background-color 0.3s; 
      background-color: #198450; /* Button color */
      padding: 10px 20px;
      text-decoration: none;
    }
    .btn-schedule:hover {
      background-color: #155724; 
      color: white; /* Darker green on hover */
      width: 100%; /* Make buttons full width */
      margin-top: 10px; /* Space between buttons */
      font-size: 20px; /* Adjust font size */
      
      border-radius: 15px; /* Rounded button corners */
      transition: background-color 0.3s; 
      
      padding: 10px 20px;
      text-decoration: none;
    }
    .btn-remove {
        width: 100%; /* Make buttons full width */
      margin-top: 10px; /* Space between buttons */
      font-size: 18px; /* Adjust font size */
      color: white;
      border-radius: 20px; /* Rounded button corners */
      transition: background-color 0.3s; 
      background-color: #dc3545; /* Button color */
      padding: 10px 20px;
      text-decoration: none;
    }
    .btn-remove:hover {
      background-color: #c82333; /* Darker red on hover */
      color: white; 
      width: 100%; /* Make buttons full width */
      margin-top: 10px; /* Space between buttons */
      font-size: 18px; /* Adjust font size */
     
      border-radius: 20px; /* Rounded button corners */
      transition: background-color 0.3s; 
      
      padding: 10px 20px;
      text-decoration: none;
    }
    .card-body {
      padding: 20px; /* Increase padding */
      text-align: center; /* Center align text */
    }
    .card-title {
      font-size: 1.5em; /* Increase title font size */
      font-weight: bold; /* Bold title */
    }
    .card-text {
      font-size: 1.1em; /* Increase text size */
      margin-bottom: 10px; /* Space between paragraphs */
    }
    .content-wrapper {
  flex: 1; /* This makes the content area grow to fill the available space */
}

  </style>
</head>
<body>
<div class="content-wrapper">
<header >
    <div class="d-flex align-items-center justify-content-between p-3">
      <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
      <div data-aos="fade-up"> 
        <a href="Home.php">Home</a> 
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

<h3>Your Favorite Properties</h3>
<div class="container">
  <div class="row">
  <?php
  // Fetch favorite properties for the logged-in user
  $favorites_sql = "
    SELECT properties.*, favorites.* 
    FROM favorites 
    JOIN properties ON favorites.property_id = properties.property_id 
    WHERE favorites.buyer_id = '{$_SESSION['buyer_id']}'";
  $favorites_result = mysqli_query($conn, $favorites_sql);

  // Display favorite properties
  if (mysqli_num_rows($favorites_result) > 0) {
    while ($favorite_property = mysqli_fetch_assoc($favorites_result)) {
        // Assuming images are stored as a comma-separated string
        $images = explode(',', $favorite_property['images']);
        
        echo "<div class='col-md-4 mb-4' data-aos='fade-up'> <!-- Added AOS effect -->
                <div class='card'>
                  <div id='carousel-favorite-{$favorite_property['property_id']}' class='carousel slide' data-bs-ride='carousel' data-bs-interval='3000'>
                      <div class='carousel-inner'>";

        // Loop through images array to create carousel items
        foreach ($images as $index => $image) {
            $active_class = ($index === 0) ? 'active' : ''; // First image active
            $image_path = 'uploads/' . trim($image); // Adjust path and trim whitespace
            echo "<div class='carousel-item $active_class'>
                      <img src='$image_path' class='d-block w-100' alt='Property Image'>
                  </div>";
        }

        echo "    </div>
                  <button class='carousel-control-prev' type='button' data-bs-target='#carousel-favorite-{$favorite_property['property_id']}' data-bs-slide='prev'>
                      <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                      <span class='visually-hidden'>Previous</span>
                  </button>
                  <button class='carousel-control-next' type='button' data-bs-target='#carousel-favorite-{$favorite_property['property_id']}' data-bs-slide='next'>
                      <span class='carousel-control-next-icon' aria-hidden='true'></span>
                      <span class='visually-hidden'>Next</span>
                  </button>
                </div>
                <div class='card-body'>
                  <h5 class='card-title'>" . htmlspecialchars($favorite_property['title']) . "</h5>
                  <p class='card-text'>Price: " . htmlspecialchars($favorite_property['price']) . "</p>
                  <p class='card-text'>Location: " . htmlspecialchars($favorite_property['location']) . "</p>
                  <a href='remove_favorite.php?favorite_id=" . $favorite_property['favorite_id'] . "' class='btn-remove'><i class='fas fa-heart'></i> Remove from Favorites</a><br><br>
                  <a href='schedule_meeting.php?property_id=" . $favorite_property['property_id'] . "&seller_id=" . $favorite_property['seller_id'] . "' class='btn-schedule'><i class='fas fa-calendar-alt'></i> Schedule Meeting</a>
                </div>
              </div>
            </div>";
    }
} else {
    echo "<p>No favorite properties found.</p>";
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

<!-- AOS Initialization -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init(); // Initialize AOS
</script>
</div>
</body>
</html>
