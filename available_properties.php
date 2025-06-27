<?php
// Start session
session_start();

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>
<body>
<h3 class="mt-4">Available Properties</h3>

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
                          <p class='card-text'>Location: {$property['location']}</p>";

          // Check if favorite_id exists
          $favorite_id = $property['favorite_id'] ?? null; // Use null coalescing operator
          if ($favorite_id) {
              echo "<a href='remove_favorite.php?favorite_id={$favorite_id}' class='btn btn-danger'>Remove from Favorites</a>";
          } else {
              echo "<a href='add_to_favorites.php?property_id={$property['property_id']}' class='btn btn-primary'>Add to Favorites</a>";
          }

          echo "<a href='schedule_meeting.php?property_id={$property['property_id']}&seller_id={$property['seller_id']}' class='btn btn-success'>Schedule Meeting</a>
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
</body>