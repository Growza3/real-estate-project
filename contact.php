<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Regel Realty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Times New Roman', Times, serif;
        }
        .contact-header {
            text-align: center;
            margin: 20px 0;
        }
        .contact-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .map {
            margin-top: 20px;
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
            <a href="aboutus.php">About Us</a>
        </div>
        <div data-aos="fade-up">
        <a href="signup1.php">SignUp</a>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="contact-header">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you!</p>
    </div>

    <div class="contact-form">
        <form action="send_contact.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

    <div class="map mt-5">
        <h4>Our Location</h4>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345096587!2d144.95373531531857!3d-37.81720997975171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f3b34f1%3A0xe7b6f7f84396f6a4!2sRegel%20Realty!5e0!3m2!1sen!2sau!4v1631946338768!5m2!1sen!2sau" 
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"></iframe>
    </div>

    <div class="contact-details mt-4">
        <h4>Contact Information</h4>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> info@regelrealty.com</p>
        <p><i class="fas fa-phone"></i> <strong>Phone:</strong> +1 (123) 456-7890</p>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> 123 Main Street, City, State, Zip</p>
    </div>
</div>

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
