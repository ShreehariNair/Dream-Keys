<?php 
$s = "localhost";
$u = "DBA";
$p = "dba";
$db = "dream keys";
$q = '';
$min_price = 0;
$max_price = 0;
$properties = array();

if(isset($_GET['q'])){
    $q = $_GET['q'];

$conn = mysqli_connect($s,$u,$p,$db);

    $word = "%".$q."%";
    $query = $conn -> prepare("Select * from property where location LIKE ?");
    $query->bind_param("s", $word);
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

if(isset($_GET['minprice']) && isset($_GET['maxprice'])){
    $min_price = $_GET['minprice'];
    $max_price = $_GET['maxprice'];

    $conn = mysqli_connect($s,$u,$p,$db);
    $query = $conn -> prepare("Select * from property where price > ? and price < ?");
    $query->bind_param("ii", $min_price,$max_price);
    $query->execute();
    $result = $query -> get_result();
    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $properties[] = $row;
        }
    }
    echo json_encode($properties);
    $query -> close();
    $conn -> close();

}
if(isset($_GET['rooms']) && isset($_GET['beds'])){
    $rooms = $_GET['rooms'];
    $beds = $_GET['beds'];

    $conn = mysqli_connect($s,$u,$p,$db);
    $query = $conn -> prepare("Select * from property where rooms = ? and beds = ?");
    $query->bind_param("ii",$rooms,$beds);
    $query->execute();
    $result = $query -> get_result();
    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $properties[] = $row;
        }
    }
    echo json_encode($properties);
    $query -> close();
    $conn -> close();

}

if(isset($_GET['maxsize']) && isset($_GET['minsize'])){
    $min_size = $_GET['minsize'];
    $max_size = $_GET['maxsize'];

    $conn = mysqli_connect($s,$u,$p,$db);
    $query = $conn -> prepare("Select * from property where size >= ? and size <= ?");
    $query->bind_param("ii",$min_size,$max_size);
    $query->execute();
    $result = $query -> get_result();
    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $properties[] = $row;
        }
    }
    echo json_encode($properties);
    $query -> close();
    $conn -> close();

}
?>
