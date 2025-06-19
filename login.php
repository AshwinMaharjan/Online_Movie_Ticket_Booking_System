<?php include("connect.php") ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">

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

        <li><a class="nav-link scrollto active" href="movies.php">Movies</a></li>
        <li><a class="nav-link scrollto active" href="theater.php">Theater</a></li>
        <li><a class="nav-link scrollto active" href="login.php">Login</a></li>
        <li><a class="nav-link scrollto active" href="register.php">Register Now</a></li>

        </ul>
      </nav>
    </div>
</div>

<form action="login.php" method="post" class="php-email-form aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
  <div class="row gy-4">

    <div class="col-md-6">
      <label for="email-field" class="pb-2">Your Email</label>
      <input type="email" class="form-control" name="email" id="email-field" required="">
    </div>

    <div class="col-md-6">
      <label for="password-field" class="pb-2">Your Password</label>
      <input type="password" class="form-control" name="password" id="password-field" required="">
    </div>

    <button type="submit" name="login">Login</button>
  </div>
  <br><br>
  <div class="form-footer">
    <p>Don't have an account? <a href="register.php" class="register-link">Register Now</a></p>
  </div>
</form>

            <footer class="footer">
    <div class="container">
        <p>&copy; Copyright 2025. All rights reserved. <br><br>
          <b>Designed by Ashwin Maharjan</b> </p>
    </div>
</footer>

</body>
</html>

<?php

if(isset ($_POST['login'])){

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql="SELECT * FROM `users` WHERE email = '$email' and password = '$password' ";

  $result= mysqli_query($con,$sql);

  if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_array($result);

    $role = $data['roteype'];

    $_SESSION['uid'] = $data['userid'];
    $_SESSION['type'] = $role;

    if($role==1){
      echo "<script> alert('Admin Login Successfully!!')</script>";
      echo "<script> window.location.href='admin/dashboard.php'; </script>";
    }

    if($role==2){
      echo "<script> alert('User Login Successfully!!')</script>";
      echo "<script> window.location.href='index.php'; </script>";
    }
  }else{
    echo "<script> alert('Invalid Email and Password')</script>";
        
  }
} 

?>