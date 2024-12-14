<?php
  include 'config.php';

  session_start();

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_text = mysqli_real_escape_string($con, $_POST['comment_text']);
    $blog_id = $_POST['blog_id'];
    $author = $_SESSION['username']; // Assuming the user is logged in

    // Validate comment input
    if (!empty($comment_text)) {
      // Insert the comment into the database
      $sql = "INSERT INTO comments (blog_id, author, content) VALUES ('$blog_id', '$author', '$comment_text')";
      
      if (mysqli_query($con, $sql)) {
        header("Location: blog-details.php?id=$blog_id"); // Redirect back to the blog details page
      } else {
        echo "Error: " . mysqli_error($con);
      }
    } else {
      echo "Comment text is required!";
    }
  }
?>