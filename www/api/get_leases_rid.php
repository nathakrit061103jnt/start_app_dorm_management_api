<?php
header('Content-Type: application/json');
if (isset($_GET["rid"])) {
    include 'DatabaseConfig.php'; 
    $sql = "SELECT * FROM leases l WHERE rid='{$_GET["rid"]}'";
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
}