<?php

$servername = "localhost";
$username = "root";  
$password = "";  
$database = "dream keys";  


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['Name'];
$email = $_POST['Email'];
$message = $_POST['Message'];


$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$message = mysqli_real_escape_string($conn, $message);


$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

if(mysqli_query($conn,$sql)){
    header("Location: success.html");
    exit();
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$conn->close();
?>
