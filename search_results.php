<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "mini_project");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the search criteria from the form
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $budget = mysqli_real_escape_string($conn, $_POST['budget']);

    // Create the search query
    $query = "SELECT * FROM properties WHERE 
              location LIKE '%$location%' AND 
              type LIKE '%$type%' AND 
              size LIKE '%$size%' AND 
              price <= '$budget'";

    $result_single = mysqli_query($conn, $query);
    
} else {
    echo "<h3>No property found</h3>";
    exit(); // Stop further execution if no ID is provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zillion - Property Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Times New Roman', Times, serif;
            background-color: #78B7D0; /* Light gray background for professionalism */
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
            margin: 0;
            padding: 0;
        }

        .d-flex a {
            color: white;
            text-decoration: none;
            margin-inline: 10px;
            font-size: 26px;
        }

        .d-flex a:first-child {
            margin-left: 400px;
        }

        .container {
            margin-top: 50px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .carousel-item img {
            border-radius: 8px;
            max-height: 500px; /* Adjust max height */
            object-fit: cover; /* Maintain aspect ratio */
        }

        h5 {
            font-weight: bold;
            margin-top: 20px;
            color: #343a40;
            font-size: 26px; /* Increased font size for headings */
        }

        p {
            margin: 5px 0;
            color: #495057;
            font-size: 22px; /* Increased font size for body text */
        }

        .btn {
            margin-top: 10px;
            width: 100%;
        }

        .btn-fav {
            background-color: #ff5a5f;
            color: white;
        }

        .btn-remove {
            background-color: #dc3545;
            color: white;
        }

        .btn-schedule {
            background-color: #007bff;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .property-details {
            margin-top: 20px;
            font-size: 24px;
        }

        .icon-text {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .icon-text i {
            margin-right: 8px;
            color: #007bff; /* Icon color */
        }

        .section-title {
            font-weight: bold;
            margin-top: 30px;
            font-size: 28px;
            color: #007bff; /* Section title color */
            border-bottom: 2px solid #007bff; /* Line under title */
            padding-bottom: 8px;
        }

        hr {
            border: 1px solid #007bff; /* Line color between sections */
            margin: 20px 0;
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
    </style>
</head>
<body>
<header >
    <div class="d-flex align-items-center justify-content-between p-3">
        <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
        <div data-aos="fade-up"> 
            <a href="Home.php">Home</a> 
            <a href="properties.php">Properties</a>
            <a href="#">Contact Us</a>
            <a href="#">About Us</a>
        </div>
        <div data-aos="fade-up">
            <a href="SignUp.html">SignIn</a>
            <a href="Admin_LogIn.html">Admin</a>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="row">
        <?php
        // Display properties without card format
        if (mysqli_num_rows($result_single) > 0) {
            while ($property = mysqli_fetch_assoc($result_single)) {
                // Split the images string into an array
                $images = explode(',', $property['images']); // Adjust according to your image delimiter

                // Image carousel
                echo "<div id='carousel-{$property['property_id']}' class='carousel slide mb-4' data-bs-ride='carousel' data-bs-interval='3000'>
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
                        </div>"; // End of carousel div

                // Display property details with enhanced styling
                echo "<div class='property-details'>
                        <div class='section-title'>Property Information</div>
                        <div class='icon-text'><i class='fas fa-tag'></i><p>Price: {$property['price']}</p></div>
                        <hr>
                        <div class='section-title'>Location</div>
                        <div class='icon-text'><i class='fas fa-map-marker-alt'></i><p>Location: {$property['location']}</p></div>
                        <hr>
                        <div class='section-title'>Description</div>
                        <div class='icon-text'><i class='fas fa-info-circle'></i><p>Description: {$property['description']}</p></div>
                        <hr>
                        <div class='section-title'>Details</div>
                        <div class='icon-text'><i class='fas fa-arrows-alt'></i><p>Size (in sqft): {$property['size']}</p></div>
                        <div class='icon-text'><i class='fas fa-home'></i><p>Property Type: {$property['type']}</p></div>
                        <div class='icon-text'><i class='fas fa-bed'></i><p>No of Bedrooms: {$property['bedrooms']}</p></div>
                        <div class='icon-text'><i class='fas fa-bath'></i><p>No of Bathrooms: {$property['bathrooms']}</p></div>
                        <div class='icon-text'><i class='fas fa-parking'></i><p>Parking Available: {$property['parking']}</p></div>
                        <hr>
                        <a href='add_to_favorites.php?property_id={$property['property_id']}' class='btn btn-fav'><i class='fas fa-heart'></i> Add to Favorites</a>
                        <a href='schedule_meeting.php?property_id={$property['property_id']}&seller_id={$property['seller_id']}' class='btn btn-schedule'><i class='fas fa-calendar-alt'></i> Schedule Meeting</a><br/><br/>
                    </div><br/><br/>";

            }
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
