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
  
$username = mysqli_real_escape_string($conn, $result['username']);
$password = mysqli_real_escape_string($conn, $result['password']);
$password = md5($password);

$Sql_Query = "SELECT * FROM renter r
                JOIN leases l USING(rid)
                WHERE username='$username'
              AND r.password='$password' LIMIT 1";
$result = mysqli_query($conn, $Sql_Query);

if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION["username"] = $data["username"];
        $_SESSION["rid"] = $data["rid"];

        echo json_encode([
            "status" => 200,
            "message" => "เข้าสู่ระบบสำเร็จ",
            "error" => false,
            "rid" => $data["rid"],
            "r_name" => $data["r_name"],
            "r_tel" => $data["r_tel"],
            "r_idcard" => $data["r_idcard"],
            "r_add" => $data["r_add"],
            "r_email" => $data["r_email"],
            "username" => $data["username"],
            "leases_id" => $data["leases_id"],
            "room_id" => $data["room_id"],
            "leases_date" => $data["leases_date"],
            "expires_date" => $data["expires_date"],
            "l_c_e" => $data["l_c_e"],
            "l_c_w" => $data["l_c_w"],
            "l_rent" => $data["l_rent"],
        ]);

    }

    // echo "เข้าสู่ระบบสำเร็จ";

} else {
    http_response_code(404);
    echo json_encode([
        "status" => 404,
        "message" => "ไม่พบบัญชีผู้ใช้งาน",
        "error" => true,
    ]);
    // echo "ไม่พบบัญชีผู้ใช้งาน";

}

mysqli_close($conn);

}
