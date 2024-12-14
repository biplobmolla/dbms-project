<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

date_default_timezone_set('UTC');
date_default_timezone_set('Asia/Dhaka');

$author = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($image_type, $allowed_types) && $image_size <= 5000000) {
            $image_new_name = time() . '-' . basename($image_name);
            $image_upload_dir = 'uploads/';
            $image_path = $image_upload_dir . $image_new_name;

            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $sql = "INSERT INTO blogs (title, author, content, image_url) 
                        VALUES ('$title', '$author', '$content', '$image_path')";
                if (mysqli_query($con, $sql)) {
                    header("Location: index.php");
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Invalid image format or size. Please upload a JPEG, PNG, or GIF file (max size 5MB).";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Blog</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <div class="create-blog-container">
      <header>
        <nav>
          <div class="logo">
            <a href="#">Blog</a>
          </div>
          <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="create-blog.php">Create Blog</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </header>

      <main>
        <section class="form-container">
          <h2>Create a New Blog Post</h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="create-blog-form" enctype="multipart/form-data">
            <div class="input-group">
              <label for="blog-title">Blog Title</label>
              <input type="text" id="blog-title" name="title" placeholder="Enter blog title" required />
            </div>

            <div class="input-group">
              <label for="blog-content">Blog Content</label>
              <textarea id="blog-content" name="content" placeholder="Write your blog content here..." rows="10" required></textarea>
            </div>

            <div class="input-group">
                <label for="image">Upload Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <button name="submit" type="submit" class="submit-btn">Create Blog</button>
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
