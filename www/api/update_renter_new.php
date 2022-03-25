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

include_once "./DatabaseConfig.php";
       
                $rid = mysqli_real_escape_string($conn, $result['rid']);
                $r_name = mysqli_real_escape_string($conn, $result['r_name']);
                $r_tel = mysqli_real_escape_string($conn, $result['r_tel']);
                $r_idcard = mysqli_real_escape_string($conn, $result['r_idcard']);
                $r_add = mysqli_real_escape_string($conn, $result['r_add']);
                $r_email = mysqli_real_escape_string($conn, $result['r_email']);
                $username = mysqli_real_escape_string($conn, $result['username']);  

                // $arrList=[
                //     'r_name' => $r_name,
                //     'r_tel' => $r_tel,
                //     'r_idcard' => $r_idcard,
                //     'r_add' => $r_add,
                //     'r_email' => $r_email,
                //     'username' => $username,
                // ];

                //         echo json_encode([
                //             'status' => 200,
                //             'message' => $arrList,
                //             'error' => false,
                //         ]); 
 
                $Sql_Query = "UPDATE `renter` SET `r_name` = '$r_name', `r_tel` = '$r_tel',
                            `r_idcard` = '$r_idcard', `r_add` = '$r_add',
                            `r_email` = '$r_email', `username` = '$username'
                            WHERE `renter`.`rid` = '$rid';";

                if (mysqli_query($con, $Sql_Query)) {

                        echo json_encode([
                            'status' => 200,
                            'message' => 'เเก้ไขข้อมูลเช่าสำเร็จ',
                            'error' => false,
                        ]); 

                } else {
                    
                       echo json_encode([
                        'status' => 400,
                        'message' => 'ลองอีกครั้ง',
                        'error' => true,
                       ]);

                }
                mysqli_close($con);
}
?>