<?php
    header('Content-Type: application/json');

    header("Access-Control-Allow-Origin: *");

    header("Content-Type: application/json; charset=UTF-8");

    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

    header("Access-Control-Max-Age: 3600");

    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName); 
    $sql ="";
    if(isset($_GET["rid"])){
         $rid=$_GET["rid"];
         $sql = "SELECT * FROM renter WHERE rid=$rid";
    }else{
        $sql = "SELECT * FROM renter";
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

    if(isset($_GET["rid"])){
        echo json_encode($data[0]  );
   }else{
       echo json_encode($data  );
   }

    
 