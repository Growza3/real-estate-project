// Example: Fetching and displaying users
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "empire");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM signup";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         header {
            background-color: #fff;
            color: #ffffff;
            padding: 15px 0;
            text-align: center;
        }
        a {
            font-family: 'Times New Roman', Times, serif;
            font-size: 32px;
            text-decoration: none;
            color: black;
            margin-inline: 20px;
        }
        a:hover{
            color: black;
            background-color: white;
            font-size: 20px;
            text-decoration: none;
            border-radius: 10px;
        }
        .button{
            font-size: 20px;
            color:white;
            background-color: black;
            padding: 8px;
            border-radius: 10px;
        }
        table{
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body>
<header >
    <div class="d-flex align-items-center justify-content-between p-3">
      <img data-aos="zoom-in" src="Empire2.png" alt="logo" height="150" width="150"/>
      <div data-aos="fade-up">
        <a href="Admin_Dashboard.php">Admin Dashboard</a>
      </div>
    </div>
  </header>
    <div class="container">
        <h2 class="mt-4">User Management</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nm']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['con']; ?></td>
                    <td>
                        <a href="Edit_User.php?id=<?php echo $row['email']; ?>" class="button">Edit</a>
                        <a href="delete_user.php?email=<?php echo urlencode($row['email']); ?>" class="button" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
