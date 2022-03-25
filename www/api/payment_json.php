<?php
 


header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 
//อ่านข้อมูลที่ส่งมาแล้วเก็บไว้ที่ตัวแปร data
$data = file_get_contents("php://input");

//แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
$result = json_decode($data, true);
$requestMethod = $_SERVER["REQUEST_METHOD"];
//ตรวจสอบว่าเป็น Method  POST หรือไม่
if ($requestMethod == 'POST') {
 
include 'DatabaseConfig.php'; 

// $username = mysqli_real_escape_string($conn, $result['username']);



$invoice_id =  mysqli_real_escape_string($conn, $result['invoice_id']); 
$leases_id = mysqli_real_escape_string($conn, $result['leases_id']); 

$room_id = mysqli_real_escape_string($conn, $result['room_id']); 
$pay_total = mysqli_real_escape_string($conn, $result['pay_total']);  

$image_base64 = mysqli_real_escape_string($conn, $result['image']);  

$date = date("Y/m/d H:i:s");
$d = md5($date);

//save uploaded image file
$image = $image_base64;
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
}