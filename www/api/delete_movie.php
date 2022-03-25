<?php
include 'DatabaseConfig.php';

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
$m_id = $_POST['m_id'];
$Sql_Query = "DELETE FROM movies WHERE movie_id ='$m_id' ";

if (mysqli_query($con, $Sql_Query)) {
    echo 'ลบข้อมูลเรียบร้อยแล้ว';
} else {
    echo "ลองอีกคร2ัง ";
}
mysqli_close($con);