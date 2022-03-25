<?php
include 'DatabaseConfig.php';
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
$m_id = $_POST['m_id'];
$m_name = $_POST['m_name'];
$m_year = $_POST['m_year'];
$m_rating = $_POST['m_rating'];
$Sql_Query = "UPDATE movies SET movie_name='$m_name', year_in='$m_year', rating='$m_rating' WHERE
movie_id='$m_id' ";
if (mysqli_query($con, $Sql_Query)) {
    echo 'Data Updated Successfully';
} else {

    echo 'Try Again';

}
mysqli_close($con);