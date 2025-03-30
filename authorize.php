<?php
$s = "localhost";
$u = "DBA";
$p = "dba";
$db = "dream keys";
$username = $_POST['username'];
$password = $_POST['pw'];
$user = [];
$conn = mysqli_connect($s,$u,$p,$db);
$query = $conn -> prepare("Select * from users where user_id = ?");
$query -> bind_param('s',$username);
$query -> execute();
$result = $query -> get_result();
while($row = $result -> fetch_assoc()){
    array_push($user,$row);
};
$query -> close();
$conn->close();

if(password_verify($password,$user[0]['hashed_password'])){
    session_start();
    $_SESSION['username'] = $user[0]['user_id'];
    $_SESSION['password'] = $user[0]['hashed_password'];
    echo 'True';
} else {
    echo 'False';
}

?>