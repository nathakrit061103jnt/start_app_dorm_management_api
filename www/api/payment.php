<?php

include_once "./DatabaseConfig.php";

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'DatabaseConfig.php';
$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$invoice_id = $_POST['invoice_id'];
$leases_id = $_POST['leases_id'];

$room_id = $_POST['room_id'];
$pay_total = $_POST['pay_total'];

$date = date("Y/m/d H:i:s");
$d = md5($date);

//save uploaded image file
$image = $_POST["image"];
$decodedImage = base64_decode("$image");
$filename = $d . uniqid(rand(), true) . ".png";

//end save
$Sql_Query = "INSERT INTO `payment` (`pay_id`, `room_id`, `pay_date`, `pay_total`, `pay_pic`)
              VALUES (NULL, '$room_id', current_timestamp(), '$pay_total', '$filename');";

if (mysqli_query($con, $Sql_Query)) {
    $return = file_put_contents("../admin/img/payment/$filename", $decodedImage);
    if ($return == true) {
        // echo 'อัพโหลดสลิปเรียบร้อย';
        // echo'แจ้งชำระบิลเรียบร้อย';

        include "./function.php";
        $pay_id = pay_id_DESC($con);

        $sql_update = "UPDATE invoice SET Invoice_status=1,pay_id='$pay_id'
                       WHERE `invoice`.`invoice_id` = '$invoice_id';";
        if (mysqli_query($con, $sql_update)) {
            // echo 'แจ้งชำระบิลเรียบร้อย';
            echo json_encode([
                "status" => 200,
                "message" => "แจ้งชำระบิลเรียบร้อย",
                "error" => false,
            ]);
        } else {
            // echo 'ลองใหม่อีกครั้ง';
            echo json_encode([
                "status" => 404,
                "message" => "ลองใหม่อีกครั้ง",
                "error" => true,
            ]);
        }
    } else {
        // echo 'Image Uploaded Failed';
        // echo 'ลองใหม่อีกครั้ง';
        echo json_encode([
            "status" => 404,
            "message" => "ลองใหม่อีกครั้ง",
            "error" => true,
        ]);

    }
} else {
    // echo 'ลองใหม่อีกครั้ง';
    echo json_encode([
        "status" => 404,
        "message" => "ลองใหม่อีกครั้ง",
        "error" => true,
    ]);

}

mysqli_close($con);