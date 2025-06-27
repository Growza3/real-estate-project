<?php 
session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "mini_project");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Assuming login form data is sent via POST
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query to check if the user exists (make sure to hash passwords for security)
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    // If the user exists
    $loginSuccessful = true;
    $userEmail = $email; // Fetch the email from the form
    $_SESSION['email'] = $userEmail; // Store user email in session
    header("Location: buyer_profile.php");
    exit();
  } else {
    $loginSuccessful = false;
    echo "Login failed!";
  }
} else {
  $loginSuccessful = true; // Set to false if not a POST request
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Regel Realty</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" >
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Home.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>
<body>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
        duration: 1200, // Duration of animation in milliseconds
    });
  </script>

  <!--Header-->
  <header>
  <div class="d-flex align-items-center justify-content-between p-3">
    <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
    <div data-aos="fade-up">
      <a href="properties.php">Buy</a>
      <a href="seller_profile.php">Sell</a>
      <a href="contact.php">Contact Us</a>
      <a href="aboutus.php">About Us</a>
    </div>
    <div data-aos="fade-up">
      <?php if ($isLoggedIn): ?>
        <a href="buyer_profile.php">
          <div class="fa fa-user" id="login-btn"> Profile</div>
        </a>
      <?php else: ?>
        <a href="signup1.php">
          <div class="fa fa-user" id="login-btn"> SignUp</div>
        </a>
      <?php endif; ?>
      <a href="Admin_LogIn.html">Admin</a>
    </div>
  </div>
</header>

  <!-- Main Content -->
  <div  data-aos="zoom-in" class="main">
    <center>
      <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="300" width="300"/>
      <p style="font-size: 50px; font-weight: 600; font-family: 'Times New Roman', Times, serif;">Turn Your Dreams Into Addresses</p>
    </center>
  </div>
<br/><br/><br/><br/><br/><br/>
  <div class="video-background">
    <video autoplay loop muted playsinline data-aos="zoom-in">
      <source src="video1.mp4" type="video/mp4" height="500px">
      Your browser does not support the video tag.
    </video>
    <!-- Sliding Text -->
    <div class="sliding-text">
      <img src="Empire3_1.png" alt="logo" height="150" width="150"/>
      <h4 style="font-size: 32px;">Turn Your Dreams Into Reality With Empire Properties!</h4>
      <img src="Empire3_1.png" alt="logo" height="150" width="150"/>
    </div>
  </div>
  <!-- Search Tab with Floating Labels -->
  <div class="searchTab" data-aos="zoom-in">
    <form method="POST" action="search_results.php">
        <div class="row g-3" data-aos="fade-up">
            <div class="col-md-3">
                <div class="form-floating">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="Mumbai/Pune">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <label for="type">Property Type</label>
                    <input type="text" name="type" class="form-control" id="type" placeholder="Villa/Apartment/House">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <label for="size">Size</label>
                    <input type="text" name="size" class="form-control" id="size" placeholder="1BHK/2BHK">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <label for="budget">Budget</label>
                    <input type="text" name="budget" class="form-control" id="budget" placeholder="50k/1cr">
                </div>
            </div>
        </div>
        <button data-aos="zoom-in" type="submit" class="submitbtn fa fa-search"> Search</button>
    </form>
</div>

<!-- Footer -->
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
