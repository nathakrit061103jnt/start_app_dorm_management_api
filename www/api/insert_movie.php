<?php

include_once "./DatabaseConfig.php";

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$m_name = $_POST['m_name'];
$m_year = $_POST['m_year'];
$m_rating = $_POST['m_rating'];

$Sql_Query = "insert into movies (movie_name, year_in, rating) values ('$m_name',$m_year,$m_rating)";

if (mysqli_query($con, $Sql_Query)) {

    echo 'Data Inserted Successfully';

} else {

    echo 'Try Again';

}
mysqli_close($con);

    <?php
        //กำหนดค่า Access-Control-Allow-Origin เพื่อให้สิทธิการเข้าถึงข้อมูล
        header("Access-Control-Allow-Origin: *");

        header("Content-Type: application/json; charset=UTF-8");

        header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

        header("Access-Control-Max-Age: 3600");

        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        //เชื่อมต่อฐานข้อมูล
        include_once "./config/connectDB.php";

        //อ่านข้อมูลที่ส่งมาแล้วเก็บไว้ที่ตัวแปร data
        $data = file_get_contents("php://input");

        //แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
        $result = json_decode($data, true);

        //ตรวจสอบว่าเป็น Method  POST หรือไม่
        if ($requestMethod == 'POST') {

                if ($result['action'] == "createEmployees") {

                        $firstName = mysqli_real_escape_string($conn, $result['first_name']);
                        $lastName = mysqli_real_escape_string($conn, $result['last_name']);

                        //คำสั่ง SQL สำหรับเพิ่มข้อมูลใน Database
                        $sql = "INSERT INTO employees (id,first_name,last_name) VALUES (NULL,'$firstName','$lastName')";

                        if (mysqli_query($conn, $sql)) {
                                echo json_encode([
                                        'status' => 200,
                                        'message' => 'New record created successfully',
                                        'error' => false,
                                ]);
                        } else {
                                $mes = "Error: " . $sql . "<br>" . mysqli_error($conn);
                                echo json_encode([
                                        'status' => 404,
                                        'message' => $mes,
                                        'error' => true,
                                ]);

                        }

                        mysqli_close($conn);

                }

        }
        ?>