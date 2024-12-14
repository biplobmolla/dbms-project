<?php
  include 'config.php';
  session_start();

  // Redirect to login page if user is not logged in
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
  }

  // Fetch user data from the database
  $username = $_SESSION["username"];
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $query = mysqli_query($con, $sql);

  if(mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
  } else {
    echo "<p>User not found.</p>";
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <?php include 'header.php'; ?>

    <main>
      <section class="profile-container">
        <h2>Profile of <?php echo htmlspecialchars($user['full_name']); ?></h2>
        <div class="profile-details">
          <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
          <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
          <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
          <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
          <p><strong>Joined on:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
        </div>
        <a href="edit-profile.php" class="submit-btn">Edit Profile</a>
      </section>
    </main>

    <footer>
      <div class="footer-copyright">
        <p>&copy; 2024 Blog. All rights reserved.</p>
      </div>
      <div class="footer-links">
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
    </footer>
  </body>
</html>
