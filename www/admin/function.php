<?php

function findOne_asc($conn)
{
    $sql = "SELECT * FROM `renter` ORDER BY `renter`.`rid` DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            return $data["rid"];
        }
    } else {
        return -1;
    }

}

function update_s_room($conn, $room_id)
{
    $sql = "UPDATE `room` SET `room_status` = '1' WHERE `room`.`room_id` = '$room_id';";

    if (mysqli_query($conn, $sql)) {
        return 1;
    } else {
        return 0;
    }

}

function check_bil($conn, $leases_id, $month)
{
    $sql = "SELECT * FROM invoice i JOIN leases l USING(leases_id) JOIN renter ren USING(rid)
            JOIN room r USING(room_id) JOIN roomtype rt USING(room_tid) WHERE i.invoice_month
            LIKE '%$month%' AND r.room_status=1 AND
            l.leases_id = '$leases_id';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return 1;
    } else {
        return 0;
    }

}

function check_payment($conn, $leases_id, $month)
{
    $sql = "SELECT * FROM invoice i JOIN leases l USING(leases_id) JOIN renter ren USING(rid)
            JOIN room r USING(room_id) JOIN roomtype rt USING(room_tid) WHERE i.invoice_month
            LIKE '%$month%' AND r.room_status=1 AND
            l.leases_id = '$leases_id'  ;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row["Invoice_status"];
        }

    } else {
        return 0;
    }

}

function get_meter_before($conn, $leases_id, $month)
{
    $date = date_create($month);
//  $date = date_create("2021-03");
    $m = date_format($date, "m");
    $y = date_format($date, "Y");
    $m = intval($m) - 1;
    $m = "0{$m}";
    $dd = "{$y}-{$m}";

    $date = date_create($dd);
    $dd = date_format($date, "Y-m");

    $sql = "SELECT * FROM invoice i JOIN leases l USING(leases_id) JOIN renter ren USING(rid)
            JOIN room r USING(room_id) JOIN roomtype rt USING(room_tid) WHERE i.invoice_month
            LIKE '%2021-02%' AND r.room_status=1 AND
            l.leases_id = '$leases_id' AND i.pay_id=0";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            return [
                $data["meters_wnew"], $data["meters_lnew"],
            ];
        }

    } else {
        return [
            0, 0,
        ];
    }

}

function check_payment_1($conn, $leases_id)
{
    $sql = "SELECT * FROM invoice i JOIN leases l USING(leases_id) JOIN renter ren USING(rid)
              JOIN room r USING(room_id) JOIN roomtype rt USING(room_tid) WHERE r.room_status=1
               AND l.leases_id = '$leases_id'  ;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return 1;
    } else {
        return 0;
    }

}

function get_invoice_id($conn, $leases_id, $month)
{
    $sql = "SELECT * FROM invoice i JOIN leases l USING(leases_id) JOIN renter ren USING(rid)
            JOIN room r USING(room_id) JOIN roomtype rt USING(room_tid) WHERE i.invoice_month
            LIKE '%$month%' AND r.room_status=1 AND
            l.leases_id = '$leases_id' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            return $data["invoice_id"];
        }
    } else {
        return 0;
    }

}




function dateThFormat($m){
 

    switch ($m) {
        case "01":
            return "มกราคม";
            break;
        case "02":
            return "กุมภาพันธ์";
            break;
        case "03":
            return "มีนาคม";
            break;
        case "04":
            return "เมษายน";
            break;
        case "05":
            return "พฤษภาคม";
            break;
        case "06":
            return "มิถุนายน";
            break;
        case "07":
            return "กรกฎาคม";
            break; 
        case "08":
            return "สิงหาคม";
            break;
        case "09":
            return "กันยายยน";
            break;
        case "10":
            return "ตุลาคม";
            break;
        case "11":
            return "พฤศจิกายน";
            break;
        case "12":
            return "ธันวาคม";
            break; 
        default:
            return $m;
    }

}