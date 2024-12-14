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

  if(isset($_POST["submit"])){
    $full_name = mysqli_real_escape_string($con, $_POST["full_name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($con, $_POST["confirm_password"]);

    if($full_name && $email){
      if($password && $password == $cpassword){
        $hash = sha1($password);
        $update_sql = "UPDATE users SET full_name='$full_name', email='$email', password='$hash' WHERE username='$username'";
      } else {
        $update_sql = "UPDATE users SET full_name='$full_name', email='$email' WHERE username='$username'";
      }

      $update_query = mysqli_query($con, $update_sql);
      if($update_query){
        header("Location: profile.php");
        exit();
      } else {
        echo "<p>Error updating profile.</p>";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <?php include 'header.php'; ?>

    <main>
      <section class="form-container">
        <h2>Edit Profile</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
          <div class="input-group">
            <label for="full-name">Full Name</label>
            <input
              type="text"
              id="full-name"
              name="full_name"
              value="<?php echo htmlspecialchars($user['full_name']); ?>"
              placeholder="Enter your full name"
            />
            <span class="error-message" id="full-name-error"></span>
          </div>
          <div class="input-group">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              value="<?php echo htmlspecialchars($user['email']); ?>"
              placeholder="Enter your email"
            />
            <span class="error-message" id="email-error"></span>
          </div>
          <div class="input-group">
            <label for="password">New Password (optional)</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter your new password"
            />
            <span class="error-message" id="password-error"></span>
          </div>
          <div class="input-group">
            <label for="confirm-password">Confirm New Password</label>
            <input
              type="password"
              id="confirm-password"
              name="confirm_password"
              placeholder="Confirm your new password"
            />
            <span class="error-message" id="confirm-password-error"></span>
          </div>
          <button name="submit" type="submit" class="submit-btn">Update Profile</button>
        </form>
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
