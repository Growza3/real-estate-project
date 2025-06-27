
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="signup.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          
          <form action="SignIn.php" class="sign-in-form" method="post" enctype="multipart/form-data">
            <h2 class="title"> SignIn </h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="Email" name="email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="SignUp.php" class="sign-up-form" method="post" enctype="multipart/form-data">
            <h2 class="title">SignUp</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="file" placeholder="Profile Photo" name="profile" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Name" name="first_name" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Name" name="last_name" />
            </div>
            <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="number" placeholder="Contact No" name="phone_number" />
            </div>
            <div class="mb-3 input-field">
              <i class="fas fa-user"></i>
              <select name="role" id="role" required>
                  <option value="" disabled selected>Select Your Role</option>
                  <option value="buyer">Buyer</option>
                  <option value="seller">Seller</option>
              </select>
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email"/>
          </div>         
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="confirm_password"/>
            </div>
            <input type="submit" class="btn" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Let's join our community and make the larger connections 
              in the real estate word!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="signin4.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Let's Continue your journey with us!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="sign5.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
    <script>
      // Show the image upload field if "Agent" is selected
      const roleSelect = document.getElementById("role");
      const imageField = document.getElementById("image-field");

      roleSelect.addEventListener("change", function() {
        if (roleSelect.value === "agent") {
          imageField.style.display = "block";
        } else {
          imageField.style.display = "none";
        }
      });
    </script>
  </body>
</html>
