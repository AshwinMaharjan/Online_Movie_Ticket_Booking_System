<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Hall System</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <h1 class="sitename">Cinema Hall System</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Dashboard</a></li>
          
          <?php
          if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
              // If the user is not logged in, show these links
              echo '
              <li><a class="nav-link" href="movies.php">Movies</a></li>
              <li><a class="nav-link" href="theater.php">Theater</a></li>
              <li><a class="nav-link" href="login.php">Login</a></li>
              <li><a class="nav-link" href="register.php">Register Now</a></li>        
              ';
          } else {
              // If user is logged in
              $type = $_SESSION['type'] ?? null; // Ensure $type is set

              if ($type == 2) {
                  echo '
                  <li><a class="nav-link" href="movies.php">Movies</a></li>
                  <li><a class="nav-link" href="theater.php">Theater</a></li>
                  <li><a class="nav-link" href="viewuserbooking.php">Booking</a></li>
                  <li><a class="nav-link" href="viewprofile.php">Profile</a></li>
                  <li><a class="nav-link" href="logout.php">Logout</a></li>
                  ';
              } else {
                  echo '
                  <li><a class="nav-link" href="movies.php">Movies</a></li>
                  <li><a class="nav-link" href="theater.php">Theater</a></li>
                  <li><a class="nav-link" href="logout.php">Logout</a></li>
                  ';
              }
          }
          ?>
        </ul>
      </nav>
    </div>
</div>

</body>
</html>
