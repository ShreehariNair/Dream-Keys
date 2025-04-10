<?php
session_start();
header('Content-Type: application/json');

$conn = new mysqli('mysql-6362f39-student-86e0.c.aivencloud.com', 'avnadmin', 'AVNS_ch4yIylQ2kinVTCYSxk', 'defaultdb',11316);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'DB connection failed']);
    exit();
}

$user_id = $_SESSION['username'];
$sql = "SELECT property_id, City, Size, image_url, Owner FROM property WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

echo json_encode(['status' => 'success', 'data' => $records, 'debug_user_id' => $user_id]);
