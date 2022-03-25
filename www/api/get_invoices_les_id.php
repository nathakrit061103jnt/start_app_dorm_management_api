<?php
header('Content-Type: application/json');
include 'DatabaseConfig.php'; 
$sql = "SELECT * FROM invoice JOIN leases USING(leases_id) ORDER BY invoice_id DESC;";

if(isset($_GET["invoice_id"]) && isset($_GET["leases_id"])){
        $invoice_id = $_GET["invoice_id"]; 
        $leases_id = $_GET["leases_id"];
        $sql = "SELECT * FROM invoice JOIN leases USING(leases_id) 
                WHERE invoice_id=$invoice_id AND leases_id=$leases_id 
                ORDER BY invoice_id DESC;";
}

if(isset($_GET["invoice_id"])){
    $invoice_id = $_GET["invoice_id"];
    $sql = "SELECT * FROM invoice JOIN leases USING(leases_id) 
            WHERE invoice_id=$invoice_id 
            ORDER BY invoice_id DESC;";
}

if(isset($_GET["leases_id"])){
    $leases_id = $_GET["leases_id"];
    $sql = "SELECT * FROM invoice JOIN leases USING(leases_id) WHERE leases_id=$leases_id ORDER BY invoice_id DESC;";
}
 
$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", $conn->error);
    exit();
}
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);