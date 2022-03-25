<?php
header('Content-Type: application/json');
include 'DatabaseConfig.php'; 

$sql = "SELECT * FROM `news`";
if(isset($_GET["news_id"])){
   $news_id= $_GET["news_id"];
   $sql = "SELECT * FROM news WHERE news_id=$news_id;";
} 


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

if(isset($_GET["news_id"])){
    echo json_encode($data["data"][0]);
} else{
    echo json_encode($data);
}

