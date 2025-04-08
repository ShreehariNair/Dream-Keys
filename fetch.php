<?php
$s = "mysql-6362f39-student-86e0.c.aivencloud.com";
$u = "avnadmin";
$p = "AVNS_ch4yIylQ2kinVTCYSxk";
$db = "defaultdb";
$port = 11316;
$id = 0;

if(isset($_GET['house'])){
    $id = $_GET['house'];
    $conn = mysqli_connect($s,$u,$p,$db,$port);

    $query = $conn -> prepare("Select * from property where property_id = ?");
    $query->bind_param("i", $id);
    $query -> execute();
    $result = $query -> get_result();
    if($result -> num_rows > 0){
        while($row = $result-> fetch_assoc()){
            $properties[] = $row;
        }
    }
    echo json_encode($properties);
    $query -> close();
    $conn -> close();
}

?>