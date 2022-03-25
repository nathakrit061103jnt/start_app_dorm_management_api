<?php
header('Content-Type: application/json');
if (isset($_GET["leases_id"])) {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
    // $sql = "SELECT * FROM leases l WHERE leases_id='{$_GET["leases_id"]}'";
    $sql = "SELECT * FROM leases l WHERE leases_id='{$_GET["leases_id"]}'";
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
}