<?php

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

$conn=new mysqli("mysql-6362f39-student-86e0.c.aivencloud.com","avnadmin","AVNS_ch4yIylQ2kinVTCYSxk","defaultdb",11316);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = htmlspecialchars(trim($_POST["Name"]));
$email = htmlspecialchars(trim($_POST["Email"]));
$message = htmlspecialchars(trim($_POST["Message"]));

$errors=[];

if(empty($name)){
    $errors['name']="Please enter your name.";
}

if(empty($email)){
    $errors['email']="Please enter your email.";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors['email']="Invalid Email Format.";
}

if(empty($message)){
    $errors['message']="Please enter a message.";
}elseif(strlen($message)<10){
    $errors['message']="Message must be at least 10 characters long";
}

if(!empty($errors)){
    $_SESSION['errors']=$errors;
    $_SESSION['old_data']=$_POST;
    header("Location: contact.php");
    exit();
}


$stmt =$conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?,?,?)");
$stmt->bind_param("sss",$name,$email,$message);

if ($stmt->execute()) {
    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
} else {
header("Location: contact.php");
exit();
}

?>
