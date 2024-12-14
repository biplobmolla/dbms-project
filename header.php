<header>
  <nav>
    <div class="logo">
      <a href="index.php">Blog</a>
    </div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <?php if (isset($_SESSION['username'])): ?>
        <li><a href="create-blog.php">Create Blog</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      <?php endif; ?>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
  </nav>
</header>
