<?php
  include 'config.php';

  session_start();

  if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
  }

  date_default_timezone_set('UTC');
  date_default_timezone_set('Asia/Dhaka');

  $blog_id = $_GET['id'];
  $sql = "SELECT * FROM blogs WHERE id = '$blog_id'";
  $result = mysqli_query($con, $sql);
  $blog = mysqli_fetch_assoc($result);

  if (!$blog) {
    echo "Blog not found.";
    exit();
  }

  $related_sql = "SELECT * FROM blogs WHERE id != '$blog_id' 
  AND (title LIKE '%" . mysqli_real_escape_string($con, $blog['title']) . "%' 
  OR content LIKE '%" . mysqli_real_escape_string($con, $blog['content']) . "%') 
  ORDER BY created_at DESC LIMIT 2";
  $related_result = mysqli_query($con, $related_sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($blog['title']); ?> | Blog</title>
    <link rel="stylesheet" href="./css/styles.css" />
  </head>
  <body>
    <div class="blog-details-container">
      <!-- <header>
        <nav>
          <div class="logo">
            <a href="#">Blog</a>
          </div>
          <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
          </ul>
        </nav>
      </header> -->

      <?php include 'header.php'; ?>

      <main>
        <section class="blog-header">
          <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
          <p class="author">
  By <b><?php echo htmlspecialchars($blog['author']); ?></b> | <?php echo date("d M Y", strtotime($blog['created_at'])); ?> | 
  <span>
    <?php
      // Get the current time and the blog's created_at time
      $created_at = new DateTime($blog['created_at']);
      $now = new DateTime();

      // Calculate the difference
      $interval = $created_at->diff($now);

      // Determine the time difference in a human-readable format
      if ($interval->y > 0) {
        echo $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
      } elseif ($interval->m > 0) {
        echo $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
      } elseif ($interval->d > 0) {
        echo $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
      } elseif ($interval->h > 0) {
        echo $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
      } elseif ($interval->i > 0) {
        echo $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
      } else {
        echo 'Just now';
      }
    ?>
  </span>
</p>

        </section>

        <section class="blog-content">
          <!-- Use dynamic image URL -->
          <img
            src="<?php echo htmlspecialchars($blog['image_url']); ?>"
            alt="Blog Thumbnail"
            class="blog-thumbnail"
          />
          <p class="blog-text">
            <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
          </p>
        </section>

        <section class="comment-section">
          <h2>Comments</h2>
          <form id="comment-form" method="POST" action="post-comment.php">
            <textarea
              id="comment-text"
              name="comment_text"
              placeholder="Write your comment..."
              rows="4"
              required
            ></textarea>
            <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>" />
            <button type="submit" class="submit-btn">Post Comment</button>
          </form>

          <div class="comment-list">
            <?php
              // Fetch comments for the blog
              $comment_sql = "SELECT * FROM comments WHERE blog_id = '$blog_id' ORDER BY created_at DESC";
              $comment_result = mysqli_query($con, $comment_sql);

              while ($comment = mysqli_fetch_assoc($comment_result)) {
                $author = $comment['author'];
                if($comment["author"] == $_SESSION["username"]){
                  $author = "You";
                }
                echo "<div class='comment'>
                        <p><strong>" . htmlspecialchars($author) . ":</strong> " . nl2br(htmlspecialchars($comment['content'])) . 
                        "<span class='comment-time'>" . date("d M Y, H:i", strtotime($comment['created_at'])) . "</span></p>
                      </div>";
              }
            ?>
          </div>
        </section>

        <section class="related-posts">
          <h2>Related Posts</h2>
          <?php
            if (mysqli_num_rows($related_result) > 0) {
              while ($related_blog = mysqli_fetch_assoc($related_result)) {
                echo "<div class='related-post-card'>
                        <img src='" . htmlspecialchars($related_blog['image_url']) . "' alt='Thumbnail' />
                        <div class='related-post-content'>
                          <h3><a href='blog-details.php?id=" . $related_blog['id'] . "'>" . htmlspecialchars($related_blog['title']) . "</a></h3>
                          <p>" . htmlspecialchars($related_blog['content']) . "</p>
                        </div>
                      </div>";
              }
            } else {
              echo "<p>No related posts found.</p>";
            }
          ?>
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
