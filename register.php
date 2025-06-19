<?php include("connect.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="css/register.css">
  <style>
    .error-message {
      color: red;
      font-size: 0.85em;
      margin-top: 4px;
    }
  </style>
</head>
<body>

<?php include("header.php") ?>

<form id="registerForm" action="register.php" method="post" enctype="multipart/form-data" class="php-email-form aos-init aos-animate" data-aos="fade-up" data-aos-delay="200" novalidate>
  <div class="row gy-4">
    <div class="col-md-6">
      <label for="name-field" class="pb-2">Your Name</label>
      <input type="text" name="name" id="name-field" class="form-control" required>
      <div id="name-error" class="error-message"></div>
    </div>

    <div class="col-md-6">
      <label for="email-field" class="pb-2">Your Email</label>
      <input type="email" class="form-control" name="email" id="email-field" required>
      <div id="email-error" class="error-message"></div>
    </div>

    <div class="col-md-6">
    <label for="password-field" class="pb-2">Your Password</label>
    <input type="password" class="form-control" name="password" id="password-field" required>
    </div>

<div class="col-md-6">
  <label for="confirm-password-field" class="pb-2">Confirm Password</label>
  <input type="password" class="form-control" name="confirm_password" id="confirm-password-field" required>
  <div id="confirm-error" class="error-message"></div>
</div>

    <div class="col-md-6">
      <label for="phoneNumber-field" class="pb-2">Phone Number</label>
      <input type="tel" class="form-control" name="phone_number" id="phoneNumber-field" required>
      <div id="phone-error" class="error-message"></div>
    </div>

    <div class="col-md-6">
      <label for="dateOfBirth-field" class="pb-2">Date of Birth</label>
      <input type="date" class="form-control" name="date_of_birth" id="dateOfBirth-field" required>
      <div id="dob-error" class="error-message"></div>
    </div>

    <div class="col-md-6">
      <label for="gender-field" class="pb-2">Gender</label>
      <select class="form-control" name="gender" id="gender-field" required>
        <option value="">Select a Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Others">Others</option>
      </select>
      <div id="gender-error" class="error-message"></div>
    </div>

    <div class="col-md-6">
      <label for="city-field" class="pb-2">City</label>
      <input type="text" class="form-control" name="city" id="city-field" required>
    </div>

    <div class="col-md-6">
      <label for="country-field" class="pb-2">Country</label>
      <select class="form-control" name="country" id="country-field" required>
        <option value="">Select a Country</option>
        <option value="Nepal">Nepal</option>
        <option value="India">India</option>
        <option value="Australia">USA</option>
        <option value="Australia">China</option>
        <option value="Australia">Australia</option>
      </select>
      <div id="country-error" class="error-message"></div>
    </div>

    <div class="col-md-6">
      Profile Picture:
      <input type="file" class="form-control" name="profile_pic">
    </div>

    <button type="submit" name="register">Register Now</button>
  </div>
</form>    

<footer class="footer">
  <div class="container">
    <p>&copy; Copyright 2025. All rights reserved. <br><br>
      <b>Designed by Ashwin Maharjan</b>
    </p>
  </div>
</footer>

<!-- ✅ JavaScript Validation -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const nameField = document.getElementById("name-field");
    const phoneField = document.getElementById("phoneNumber-field");
    const dobField = document.getElementById("dateOfBirth-field");
    const emailField = document.getElementById("email-field");
    const genderField = document.getElementById("gender-field");
    const countryField = document.getElementById("country-field");

    const nameError = document.getElementById("name-error");
    const phoneError = document.getElementById("phone-error");
    const dobError = document.getElementById("dob-error");
    const emailError = document.getElementById("email-error");
    const genderError = document.getElementById("gender-error");
    const countryError = document.getElementById("country-error");

    // Disable future dates in date picker
    const today = new Date().toISOString().split("T")[0];
    dobField.setAttribute("max", today);

    nameField.addEventListener("input", function () {
      const nameRegex = /^[A-Za-z\s]+$/;
      nameError.textContent = nameRegex.test(nameField.value) ? "" : "Only alphabets and spaces allowed.";
    });

    phoneField.addEventListener("input", function () {
      const phoneRegex = /^\d{10}$/;
      phoneError.textContent = phoneRegex.test(phoneField.value) ? "" : "Phone number must be exactly 10 digits.";
    });

    emailField.addEventListener("input", function () {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      emailError.textContent = emailRegex.test(emailField.value) ? "" : "Invalid email format.";
    });

    dobField.addEventListener("change", function () {
      const selectedDate = new Date(dobField.value);
      const now = new Date();
      dobError.textContent = selectedDate > now ? "Date of birth cannot be in the future." : "";
    });

    genderField.addEventListener("change", function () {
      genderError.textContent = genderField.value === "" ? "Please select your gender." : "";
    });

    countryField.addEventListener("change", function () {
      countryError.textContent = countryField.value === "" ? "Please select your country." : "";
    });

    document.getElementById("registerForm").addEventListener("submit", function (e) {
      // Trigger all validations before submission
      nameField.dispatchEvent(new Event('input'));
      phoneField.dispatchEvent(new Event('input'));
      dobField.dispatchEvent(new Event('change'));
      emailField.dispatchEvent(new Event('input'));
      genderField.dispatchEvent(new Event('change'));
      countryField.dispatchEvent(new Event('change'));

      // Check if any errors exist
      if (
        nameError.textContent ||
        phoneError.textContent ||
        dobError.textContent ||
        emailError.textContent ||
        genderError.textContent ||
        countryError.textContent
      ) {
        e.preventDefault();
        alert("Please fix validation errors before submitting.");
      }
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    const passwordField = document.getElementById("password-field");
    const confirmPasswordField = document.getElementById("confirm-password-field");
    const confirmError = document.getElementById("confirm-error");

    function checkPasswordMatch() {
      if (confirmPasswordField.value === "") {
        confirmError.textContent = "";
      } else if (passwordField.value !== confirmPasswordField.value) {
        confirmError.textContent = "Passwords do not match.";
      } else {
        confirmError.textContent = "";
      }
    }

    passwordField.addEventListener("input", checkPasswordMatch);
    confirmPasswordField.addEventListener("input", checkPasswordMatch);

    document.getElementById("registerForm").addEventListener("submit", function (e) {
      if (passwordField.value !== confirmPasswordField.value) {
        confirmError.textContent = "Passwords do not match.";
        e.preventDefault();
      }
    });
  });
</script>

</body>
</html>

<?php
if(isset ($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_pw = $_POST['confirm_password'];
  $phone_number = preg_replace('/\D/', '', $_POST['phone_number']);
  $date_of_birth = $_POST['date_of_birth'];
  $gender = $_POST['gender'];
  $city = $_POST['city'];
  $country = $_POST['country'];

  if ($password !== $confirm_pw) {
    echo "<script>console.log('Passwords do not match');</script>";
    exit;
  }

  if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0){
    $profile_pic = $_FILES['profile_pic']['name'];
    $tmp_image = $_FILES['profile_pic']['tmp_name'];
    $file_extension = pathinfo($profile_pic, PATHINFO_EXTENSION);
    $profile_pic_new_name = uniqid() . '.' . $file_extension;
    $target_path = "uploads/" . $profile_pic_new_name;

    if(move_uploaded_file($tmp_image, $target_path)){
        $profile_pic = $profile_pic_new_name;
    } else {
        echo "<script> alert('Error uploading the image!') </script>";
        exit;
    }
  } else {
    echo "<script> alert('No image selected!') </script>";
    exit;
  }

  $sql = "INSERT INTO users(name, email, password, confirm_pw, roteype, phone_number, date_of_birth, gender, city, country, profile_pic) 
          VALUES ('$name', '$email', '$password', '$confirm_pw', '2', '$phone_number', '$date_of_birth', '$gender', '$city', '$country', '$profile_pic')";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('User Register Successful!') </script>";
    echo "<script> window.location.href='login.php'; </script>";
  } else {
    echo "<script> alert('User Register NOT Successful!') </script>";
  }
}
?>

