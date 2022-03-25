<?php


$servername = "us-cdbr-east-05.cleardb.net";
$username = "b74dac417a4664";
$password = "33252f2f";
$database = "heroku_950d7c01d4cbe04";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$con = mysqli_connect($servername, $username, $password, $database);

 

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

mysqli_set_charset($conn, "utf8");
mysqli_set_charset($con, "utf8");
