<?php
session_start();
if (isset($_SESSION["username"])) {
    echo "<script>";
    echo "location = './data_room.php';";
    echo "</script>";
} else {
    echo "<script>";
    echo "location = './login.php';";
    echo "</script>";
}