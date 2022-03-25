<?php

function pay_id_DESC($conn)
{

    $sql = "SELECT * FROM `payment` ORDER BY `payment`.`pay_id` DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row["pay_id"];
        }
    } else {
        return 0;
    }

}