<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['buyer_id'])) {
  echo "<script>alert('Please Log-In First!'); window.location.href='signup1.php';</script>";
  exit();
}

// Fetch buyer details
$buyer_id = $_SESSION['buyer_id'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch buyer details from the database with JOIN to get profile image
$buyer_query = "SELECT buyers.*, users.profile FROM buyers  
                JOIN users ON buyers.user_id = users.user_id 
                WHERE buyers.buyer_id = '$buyer_id'";
$buyer_result = mysqli_query($conn, $buyer_query);

// Check if the query returned a result
if ($buyer_result && mysqli_num_rows($buyer_result) > 0) {
    $buyer = mysqli_fetch_assoc($buyer_result);
} else {
    // Handle the case where no buyer was found
    die("Buyer not found.");
}
?>
<?php

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

// Ensure buyer_id is set in the session (you should set it when the user logs in)
if (!isset($_SESSION['buyer_id'])) {
    // Optionally handle the case where buyer_id is not set
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
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
<!-- Bootstrap JS and dependencies (jQuery) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
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
  height: 1350px;
  font-family: 'Times New Roman', Times, serif;
}
        .profile-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: black;
        }
        .profile-img {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid #16325B;
        }
        .profile-details h4 {
            color: #16325B;
        }
        .profile-details p {
            color: #16325B;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 30px;
        }
        .btn i {
            margin-right: 8px;
        }
        .card {
            height: 100%; /* Make all cards the same height */
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
  font-size: 26px;
}
.d-flex a:first-child{
  margin-left: 450px;
}

.signin-admin {
    display: flex; /* Flexbox for alignment */
    align-items: center; /* Center vertically */
    margin-left: 1200px;
}

.signin-admin a {
    margin-left: 15px; /* Space between SignIn and Admin links */
    padding: 8px 15px; /* Padding for buttons */
    border-radius: 20px; /* Rounded corners */ /* Green background */
    color: black; /* White text */
    transition: background-color 0.3s; /* Smooth transition */
}

.signin-admin a:hover {
 /* Darker green on hover */
}
.text-center h2{
  color: #16325B;
}
.btn-nav{
  background-color: #16325B;
  padding: 10px 100px;
  color: white;
  border-radius: 15px;
  text-decoration: none;
  width: 100%; /* Make buttons full width */
  margin-top: 10px; /* Space between buttons */
  font-size: 1rem;
}
.btn-nav:hover{
  background-color: darkblue;
  padding: 10px 100px;
  color: white;
  width: auto;
  border-radius: 15px;
  text-decoration: none;
}
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
    </style>
</head>
<body>

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
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>



<div class="container mt-5">
    <div class="profile-container mx-auto">
        <div class="text-center">
            <!-- Display Buyer's Profile Image -->
            <img src="<?php echo $buyer['profile']; ?>" alt="Profile Image" class="profile-img">
            <h2 class="mt-3">Welcome, <?php echo $_SESSION['email']; ?>!</h2>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 profile-details">
                <h4>Your Profile Details</h4>
                <p><i class="fas fa-user"></i> Name: <?php echo $buyer['name']; ?></p>
                <p><i class="fas fa-envelope"></i> Email: <?php echo $buyer['email']; ?></p>
            </div>
        </div>

        <!-- Navigation to other pages -->
        <div class="mt-4 text-center">
            <h3>Explore More</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Favorite Properties</h5>
                            <a href="favorite_properties.php" class="btn-nav">
                                <i class="fas fa-heart"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Scheduled Meetings</h5>
                            <a href="scheduled_meetings.php" class="btn-nav">
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
                <div class="mt-4">
            <h3 class="mt-4 text-center" >Available Properties</h3>
            </div>
        </div>

        <!-- Fetch properties from the property table -->
        

<div class="row">
  <?php
  // Display properties in cards
  if (mysqli_num_rows($result) > 0) {
    while ($property = mysqli_fetch_assoc($result)) {
      // Split the images string into an array
      $images = explode(',', $property['images']); // Adjust according to your image delimiter

      echo "<div class='col-md-4'>
              <div class='card'>
                  <div id='carousel-{$property['property_id']}' class='carousel slide' data-bs-ride='carousel' data-bs-interval='3000'>
                      <div class='carousel-inner'>";

      // Loop through image array
      foreach ($images as $index => $image) {
          if (!empty($image)) {
              $active_class = ($index === 0) ? 'active' : ''; // First image active
              $image_path = "uploads/" . trim($image); // Adjust the path as needed
              echo "<div class='carousel-item $active_class'>
                      <img src='$image_path' class='d-block w-100' alt='Property Image'> 
                    </div>";
          }
      }

      echo "  </div>
                      <button class='carousel-control-prev' type='button' data-bs-target='#carousel-{$property['property_id']}' data-bs-slide='prev'>
                          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                          <span class='visually-hidden'>Previous</span>
                      </button>
                      <button class='carousel-control-next' type='button' data-bs-target='#carousel-{$property['property_id']}' data-bs-slide='next'>
                          <span class='carousel-control-next-icon' aria-hidden='true'></span>
                          <span class='visually-hidden'>Next</span>
                      </button>
                  </div>
                  <div class='card-body'>
                      <h5 class='card-title'>{$property['title']}</h5>
                      <p class='card-text'>Price: {$property['price']}</p>
                      <p class='card-text'>Location: {$property['location']}</p>
                      <a href='property_detail.php?property_id={$property['property_id']}' class='detail'>
            View Property Details
        </a><br/><br/>"; 

      // Check if favorite_id exists
      $favorite_id = $property['favorite_id'] ?? null; // Use null coalescing operator
      if ($favorite_id) {
          echo "<a href='remove_favorite.php?favorite_id={$favorite_id}' class='btn btn-remove'><i class='fas fa-heart'></i> Remove from Favorites</a>";
      } else {
          echo "<a href='add_to_favorites.php?property_id={$property['property_id']}' class='btn btn-fav'><i class='fas fa-heart'></i> Add to Favorites</a>";
      }

      echo "<a href='schedule_meeting.php?property_id={$property['property_id']}&seller_id={$property['seller_id']}' class='btn btn-schedule'><i class='fas fa-calendar-alt'></i> Schedule Meeting</a>
                  </div>
              </div>
          </div>";
    }
  } else {
      echo "<p>No properties available.</p>";
  }
  ?>
</div>
</div>

<style>
    .property-card {
        border: none; /* Remove default border */
        border-radius: 10px; /* Rounded corners */
        overflow: hidden; /* Ensure child elements fit within rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transition: transform 0.3s; /* Transition for hover effect */
    }

    .property-card:hover {
        transform: translateY(-5px); /* Lift effect on hover */
    }

    .carousel-inner img {
        height: 200px; /* Fixed height for carousel images */
        object-fit: cover; /* Cover the entire area without distortion */
    }

    h2 {
        font-size: 2.5rem; /* Larger font for the title */
        color: #007bff; /* Color for the title */
    }

    .card-title {
        font-size: 1.5rem; /* Title font size */
        color: #16325B; /* Darker color for title */
    }

    .card-text {
        color: #16325B; /* Lighter color for text */
        font-size: 1rem; /* Normal font size */
    }

    .btn-fav{
      width: 100%; /* Make buttons full width */
        margin-top: 10px; /* Space between buttons */
        font-size: 1rem;
        color: white;

      background-color:#00308F;
    }
    .btn-schedule{
      width: 100%; /* Make buttons full width */
        margin-top: 10px; /* Space between buttons */
        font-size: 1rem;
        color: white;
      background-color:#198450;
    }
    .btn-remove{
      width: 100%; /* Make buttons full width */
        margin-top: 10px; /* Space between buttons */
        font-size: 1rem;
        color: white;
      background-color:#dc3545;
    }
</style>

        </div>
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


</body>
</html>
