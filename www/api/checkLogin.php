<?php
session_start();
if (isset($_SESSION["u_email"])) {
    echo json_encode([
        "status" => 200,
        "message" => "ผู้ใช้ล็อกอินเข้าเข้าใช้งานอยู่",
    ]);

} else {
    echo json_encode([
        "status" => 404,
        "message" => "ผู้ใช้ได้ออกจากระบบเเล้ว",
    ]);

}