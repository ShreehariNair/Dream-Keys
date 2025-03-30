<?php
$s = "localhost";
$u = "DBA";
$p = "dba";
$db = "dream keys";
$id = 0;

if(isset($_GET['house'])){
    $id = $_GET['house'];
    $conn = mysqli_connect($s,$u,$p,$db);
// if (!$conn) {
    //     die("Connection failed: ". mysqli_connect_error());
    // }
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