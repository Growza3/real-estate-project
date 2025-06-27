<?php
// Start session
session_start();


// Database connection
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch buyer details from the database with JOIN to get profile image
$buyer_query = "SELECT * FROM properties";
$result = mysqli_query($conn, $buyer_query);

// Check if the query returned a result
if ($result && mysqli_num_rows($result) > 0) {
    $buyer = mysqli_fetch_assoc($result);
} else {
    // Handle the case where no buyer was found
    die("Buyer not found.");
}
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
  background-image: url('build8.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  width: 100%;
  height: 1390px;
  font-family: 'Times New Roman', Times, serif;
}

.profile-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Slightly stronger shadow */
    color: black;
    margin: 20px auto; /* Centered margin */
    max-width: 1200px; /* Maximum width for better layout */
}

.profile-img {
    border-radius: 50%;
    width: 150px; /* Slightly smaller profile image */
    height: 150px;
    object-fit: cover;
    border: 5px solid #684A52; /* Maintained border color */
}

.profile-details h4 {
    color: #343a40; /* Darker text color */
    font-size: 1.5rem; /* Larger font size for headings */
}

.profile-details p {
    color: #6c757d; /* Lighter text for details */
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
    border: none; /* Remove default card border */
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
    font-size: 28px;

}

header img {
    height: 150px;
    margin:0;
    padding: 0;
}

.text-center h2 {
    color: #684A52; /* Maintained color */
}


.mt-4 {
    margin-top: 20px; /* Added margin for space above the heading */
}

img{
  border-radius: 10px;
}
.btn{
  width:50%;
}
.btn-fav{
  color: white;
  background-color: #16325B;
}
.btn-schedule{
  color: white;
  background-color: royalblue;
}
.btn-fav:hover{
    color: white;
    background-color: red;
}
.btn-schedule:hover{
    color: white;
    background-color: green;
}
.detail{
  color:red;
  text-decoration:none;
  font-size:20px;
}
h5{
  font-size: 28px;
}
p{
  font-size: 20px;
}
/* Footer Styling */
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
.d-flex a{
  color: white;
  text-decoration: none;
  margin-inline: 10px;
  font-size: 28px;
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
        <a href="Home.php">Home</a> 
        <a href="seller_profile.php">Sell</a>
        <a href="#">Contact Us</a>
        <a href="#">About Us</a>
      </div>
      <div data-aos="fade-up">
        <a href="SignUp.html">SignIn</a>
        <a href="Admin_LogIn.html">Admin</a>
      </div>
    </div>
  </header>

<div class="mt-4">
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
                    if (!empty(trim($image))) { // Ensure the image is not empty
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
        </a><br/><br/>";                // Check if favorite_id exists
                $favorite_id = $property['favorite_id'] ?? null; // Use null coalescing operator
                if ($favorite_id) {
                    echo "<a href='remove_favorite.php?favorite_id={$favorite_id}' class='btn btn-remove'><i class='fas fa-heart'></i> Remove from Favorites</a>";
                } else {
                    echo "<a href='add_to_favorites.php?property_id={$property['property_id']}' class='btn btn-fav'><i class='fas fa-heart'></i> Add to Favorites</a>";
                }

                echo "<a href='schedule_meeting.php?property_id={$property['property_id']}&seller_id={$property['seller_id']}' class='btn btn-schedule'><i class='fas fa-calendar-alt'></i> Schedule Meeting</a>
                        </div>
                    </div>
                </div>"; // End of card div
            }
        } else {
            echo "<p>No properties available.</p>";
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

</body>
</html>
