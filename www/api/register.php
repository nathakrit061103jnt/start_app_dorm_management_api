<?php

include_once "./DatabaseConfig.php";
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_POST['u_email'] == null or $_POST['u_password'] == null or $_POST["u_name"] == null or $_POST["u_address"] == null) {

    echo json_encode([
        "status" => 404,
        "message" => "กรุณากรอกข้อมูลให้ครบ",
        "error" => true,
    ]);

    // echo 'กรุณากรอกข้อมูลให้ครบ';

} else {
    $con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    $u_password = md5($u_password);
    $u_tel = $_POST['u_tel'];
    $u_name = $_POST["u_name"];
    $u_address = $_POST["u_address"];

    $Sql_Query = "INSERT INTO `tbl_users` (`u_id`, `u_email`, `u_password`, `u_tel`,`u_name`,`u_address`)
                  VALUES (NULL, '$u_email', '$u_password', '$u_tel','$u_name','$u_address');";

    if (mysqli_query($con, $Sql_Query)) {

        echo json_encode([
            "status" => 200,
            "message" => "สมัครสมาชิกผู้ใช้งานสำเร็จ",
            "error" => true,
        ]);

        // echo 'สมัครสมาชิกผู้ใช้งานสำเร็จ';

    } else {

        echo json_encode([
            "status" => 404,
            "message" => "ไม่สามารถสมัครสมาชิกผู้ใช้งานได้",
            "error" => true,
        ]);

        // echo 'ไม่สามารถสมัครสมาชิกผู้ใช้งานได้';

    }
    mysqli_close($con);

}