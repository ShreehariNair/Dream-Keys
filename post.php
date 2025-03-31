<?php
$s = "localhost";
$u = "DBA";
$p = "dba";
$db = "dream keys";
$property = json_decode($_POST['property'],true);
$rooms = $property['beds'] + 2;
$image_url = join('|',$property['image_url']);
if(isset($property)){
    $conn = mysqli_connect($s,$u,$p,$db);
    $query = $conn -> prepare("INSERT INTO property( name, location, city,state,street,owner, about, size, image_url, video_url,rooms, beds, baths, property_type, price, transaction_type, pincode, lat, longitude) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $query -> bind_param("sssssssissiiisisidd",$property['address'],$property['address'],$property['city'],$property['state'],$property['street'],$property['owner']['fullName'],$property['about'],$property['size'],$image_url,$property['video_url'],$rooms,$property['beds'],$property['baths'],$property['type'],$property['price'],$property['transaction'],$property['zipcode'],$property['lat'],$property['long']);
    if($query -> execute()){
        echo 'true';
    } else {
        echo 'false';
    }
    $query->close();
    $conn -> close();
}

?>