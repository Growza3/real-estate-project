<?php
session_start();

// Check if seller is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['seller_id'])) {
    header("Location: SignUp.html");
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mini_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if property_id is provided
if (!isset($_GET['property_id'])) {
    echo "Property not found!";
    exit();
}

$property_id = $_GET['property_id'];

// Fetch property details
$sql = "SELECT * FROM properties WHERE property_id = '$property_id' AND seller_id = '{$_SESSION['seller_id']}'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $property = mysqli_fetch_assoc($result);
} else {
    echo "No property found!";
    exit();
}

// Update property if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];

    // Update query
    $update_sql = "UPDATE properties SET title='$title', description='$description', location='$location', price='$price', type='$type', bedrooms='$bedrooms', bathrooms='$bathrooms' WHERE property_id='$property_id' AND seller_id = '{$_SESSION['seller_id']}'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: seller_profile.php?success=Property updated successfully");
    } else {
        echo "Error updating property: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: auto;
            margin-top: 50px;
        }
        h2 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
        }
        .btn {
            margin-top: 10px;
            width: 100%;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px;
        }
        .icon {
            margin-right: 10px;
            color: #6c757d;
        }
        .card-icons {
            font-size: 20px;
            vertical-align: middle;
        }
        html, body {
            margin: 0;
            padding: 0;
            background-image: url('build5.jpg');
            background-size: cover;
            background-position: center;
            height: 1400px;
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
<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-edit icon"></i>Edit Property</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label"><i class="fas fa-heading icon"></i>Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $property['title']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label"><i class="fas fa-align-left icon"></i>Description</label>
            <textarea class="form-control" name="description" id="description" required><?php echo $property['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label"><i class="fas fa-map-marker-alt icon"></i>Location</label>
            <input type="text" class="form-control" name="location" id="location" value="<?php echo $property['location']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label"><i class="fas fa-dollar-sign icon"></i>Price</label>
            <input type="number" class="form-control" name="price" id="price" value="<?php echo $property['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label"><i class="fas fa-building icon"></i>Type</label>
            <input type="text" class="form-control" name="type" id="type" value="<?php echo $property['type']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="bedrooms" class="form-label"><i class="fas fa-bed icon"></i>Bedrooms</label>
            <input type="number" class="form-control" name="bedrooms" id="bedrooms" value="<?php echo $property['bedrooms']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="bathrooms" class="form-label"><i class="fas fa-bath icon"></i>Bathrooms</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" value="<?php echo $property['bathrooms']; ?>" required>
        </div>
        <button type="submit" class="btn-nav"><i class="fas fa-save"></i> Update Property</button>
        <a href="seller_profile.php" class="btn-nav" style="text-align:center"><i class="fas fa-times"></i> Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
