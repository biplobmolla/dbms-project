<?php
  include 'config.php';

  if(isset($_POST["submit"])){
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    
    if($username && $password){
        $hash = sha1($password);
        $sql = "SELECT full_name, username, email FROM users WHERE (username='$username' OR email='$username') AND password='$hash'";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
          $result = mysqli_fetch_assoc($query);
          // echo "full_name: " . $result['full_name'] . ", username: " . $result['username'] . ", email: " . $result['email'];
          session_start();
          $_SESSION["username"] = $result["username"];
          header("Location: index.php");
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <div class="login-container">
      <!-- <header>
        <nav>
          <div class="logo">
            <a href="#">Blog</a>
          </div>
          <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="register.html">Register</a></li>
          </ul>
        </nav>
      </header> -->

      <?php include 'header.php'; ?>
      
      <main>
        <section class="form-container">
          <h2>Login</h2>
          <form id="login-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="input-group">
              <label for="login-username">Username or Email</label>
              <input
                type="text"
                id="login-username"
                name="username"
                placeholder="Enter your username or email"
              />
              <span class="error-message" id="login-username-error"></span>
            </div>
            <div class="input-group">
              <label for="login-password">Password</label>
              <input
                type="password"
                id="login-password"
                name="password"
                placeholder="Enter your password"
              />
              <span class="error-message" id="login-password-error"></span>
            </div>
            <button name="submit" type="submit" class="submit-btn">Login</button>
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
    </div>

    <script src="./js/scripts.js"></script>
  </body>
</html>
