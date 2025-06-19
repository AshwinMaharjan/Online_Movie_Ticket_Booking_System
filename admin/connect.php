<?php

session_start();

$servername="localhost";
$username="root";
$password="";
$dbname="dbmovies";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(!$con){
    die("Cannot Establish The Connection");
}

?>