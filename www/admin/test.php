<?php
include_once "./function.php";
include_once "./configs/connectDB.php";

$check_bil = check_bil($conn, 1, "month");

echo $check_bil;