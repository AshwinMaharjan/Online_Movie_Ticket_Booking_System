<?php
// Check if a session is already started before calling session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$servername = "localhost";  // Your database host (usually localhost)
$user = "root";       // Your database username
$pass = "";           // Your database password (default is empty for XAMPP)
$dbname = "dbmovies"; // Your database name

$con = mysqli_connect($servername, $user, $pass, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
