<?php
  include 'config.php';

  session_start();

  if(!$_SESSION["username"]){
    header("Location: login.php");
  }

  $sql = "SELECT * FROM blogs ORDER BY updated_at DESC";
  $query = mysqli_query($con, $sql);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Homepage</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <!-- <header>
      <nav>
        <div class="logo">
          <a href="#">Blog</a>
        </div>
        <ul class="nav-links">
          <li><a href="#">Home</a></li>
          <li><a href="#">Categories</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
      </nav>
    </header> -->

    <?php include 'header.php'; ?>

    <main>
      <section class="all-blogs">
        <h2>All Blogs</h2>
        <?php
          if(mysqli_num_rows($query) > 0){
        ?>
        <div class="blog-cards">
          <!-- Example Blog Card -->
           <?php
              while($row = mysqli_fetch_assoc($query)){
           ?>
          <div class="blog-card">
            <div class="thumbnail">
              <img src="<?php echo $row["image_url"]; ?>" alt="Thumbnail" />
              <div class="thumbnail-overlay">
                <h3><?php echo $row["title"]; ?></h3>
              </div>
            </div>
            <div class="content">
              <h3><?php echo $row["title"]; ?></h3>
              <p><?php echo $row["content"]; ?></p>
              <p>
                <strong>Author:</strong> <?php echo $row["author"]; ?> | 
                <strong>Date:</strong> <?php echo date("F j, Y", strtotime($row["created_at"])); ?>
              </p>
              <a href="<?php echo './blog-details.php?id=' . $row["id"] ?>">
                <button class="read-more">Read More</button>
              </a>
            </div>
          </div>
          <?php               
          }
            }else{
              echo "<p>No blog posts found.</p>";
            } ?>
        </div>
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

    <script src="./js/scripts.js"></script>
  </body>
</html>
