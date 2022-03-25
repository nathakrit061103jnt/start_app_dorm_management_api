<?php
header('Content-Type: application/json');
include 'DatabaseConfig.php'; 
$sql = "SELECT * FROM `invoice`  ORDER BY `invoice`.`invoice_id` DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", $conn->error);
    exit();
}
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data["data"][] = $row;
}
mysqli_close($conn);
echo json_encode($data);