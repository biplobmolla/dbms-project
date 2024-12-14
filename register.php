<?php
  include 'config.php';

  if(isset($_POST["submit"])){
    $full_name = mysqli_real_escape_string($con, $_POST["full_name"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($con, $_POST["confirm_password"]);
    // echo "Fullname: " . $full_name . ", " . "username: " . $username . ", " . "email: " . $email . ", " . "password: " . $password . ", " . "cpassword: " . $cpassword;

    if($full_name && $username && $email && $password && $cpassword){
      if($password == $cpassword){
        $hash = sha1($password);
        $sql = "INSERT INTO users (full_name, username, email, password) VALUES ('$full_name', '$username', '$email', '$hash')";
        $query = mysqli_query($con, $sql);
        if($query){
          header("Location: login.php");
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <!-- <header>
      <nav>
        <div class="logo">
          <a href="#">Blog</a>
        </div>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="login.html">Login</a></li>
        </ul>
      </nav>
    </header> -->

    <?php include 'header.php'; ?>

    <main>
      <section class="form-container">
        <h2>Create an Account</h2>
        <form id="register-form" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
          <div class="input-group">
            <label for="full-name">Full Name</label>
            <input
              type="text"
              id="full-name"
              name="full_name"
              placeholder="Enter your full name"
            />
            <span class="error-message" id="full-name-error"></span>
          </div>
          <div class="input-group">
            <label for="username">Username</label>
            <input
              type="text"
              id="username"
              name="username"
              placeholder="Enter your username"
            />
            <span class="error-message" id="username-error"></span>
          </div>
          <div class="input-group">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Enter your email"
            />
            <span class="error-message" id="email-error"></span>
          </div>
          <div class="input-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
            />
            <span class="error-message" id="password-error"></span>
          </div>
          <div class="input-group">
            <label for="confirm-password">Confirm Password</label>
            <input
              type="password"
              id="confirm-password"
              name="confirm_password"
              placeholder="Confirm your password"
            />
            <span class="error-message" id="confirm-password-error"></span>
          </div>
          <button name="submit" type="submit" class="submit-btn">Register</button>
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

    <!-- <script src="./js/scripts.js"></script> -->
  </body>
</html>
