<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Regel Realty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Times New Roman', Times, serif;
        }
        .about-header {
            text-align: center;
            margin: 30px 0;
            color: #343a40;
        }
        .about-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .mission-vision {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
        .team-member {
            margin-top: 20px;
        }
        .team-member img {
            border-radius: 50%;
            width: 250px;
            height: 200px;
        }
        .team-member h5 {
            margin-top: 10px;
            color: #007bff;
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
        .nav a {
            color: white;
            text-decoration: none;
            margin-inline: 10px;
            font-size: 26px;
        }
        .nav a:first-child {
            margin-left: 400px;
        }
        .btn-primary {
            background-color: #16325B; /* Match button color with header */
            border-color: #16325B; /* Match button border color with header */
        }
        .btn-primary:hover {
            background-color: #1e4f80; /* Slightly lighter shade on hover */
            border-color: #1e4f80; /* Slightly lighter shade on hover */
        }
    </style>
</head>
<body>
<header>
    <div class="nav d-flex align-items-center justify-content-between p-3">
        <img data-aos="zoom-in" src="Empire6.png" alt="logo" height="150" width="150"/>
        <div data-aos="fade-up"> 
            <a href="Home.php">Home</a> 
            <a href="seller_profile.php">Sell</a>
            <a href="buyer_profile.php">Buy</a>
            <a href="contact.php">Contact Us</a>
        </div>
        <div data-aos="fade-up">
            <a href="signup1.php">SignUp</a>
        </div>
    </div>
</header>
    <div class="container mt-5">
        <div class="about-header">
            <h2>About Us</h2>
            <p>Welcome to Regel Realty!</p>
        </div>

        <div class="about-content">
            <h4>Who We Are</h4>
            <p>At Regel Realty, we are committed to providing exceptional real estate services to our clients. With years of experience in the industry, our team of experts is dedicated to helping you find your dream home or sell your property quickly and efficiently.</p>

            <div class="mission-vision">
                <h4>Our Mission</h4>
                <p>To provide unparalleled real estate services with integrity and professionalism.</p>
                <h4>Our Vision</h4>
                <p>To be the most trusted and sought-after real estate company in the region, known for our customer-centric approach and innovative solutions.</p>
            </div>
        </div>

        <div class="team-member">
            <center><h2>Meet Our Team</h2><br/></center>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="woman.jpg" alt="Team Member 1">
                    <h5>John Doe</h5>
                    <p>CEO</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="woman.jpg" alt="Team Member 2">
                    <h5>Jane Smith</h5>
                    <p>Real Estate Agent</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="woman.jpg" alt="Team Member 3">
                    <h5>Emily Johnson</h5>
                    <p>Marketing Specialist</p>
                </div>
            </div>
        </div>
    </div>
<br/><br/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
            
            <!-- Follow Us -->
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <div class="d-flex">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center bottom-footer">
        <p>&copy; 2024 Regel Realty. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
