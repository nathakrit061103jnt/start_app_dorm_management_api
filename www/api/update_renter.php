<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "./DatabaseConfig.php";

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$r_email = $_POST['r_email'];
$r_name = $_POST["r_name"];
$r_add = $_POST["r_add"];

$Sql_Query = "UPDATE `renter` SET `r_name` = '$r_name', `r_tel` = '{$_POST["r_tel"]}',
              `r_idcard` = '{$_POST["r_idcard"]}', `r_add` = '$r_add',
              `r_email` = '$r_email', `username` = '{$_POST["username"]}'
              WHERE `renter`.`rid` = '{$_POST['rid']}';";

if (mysqli_query($con, $Sql_Query)) {

    echo 'เเก้ไขข้อมูลเช่าสำเร็จ';

} else {

    echo 'ลองอีกครั้ง';

}
mysqli_close($con);