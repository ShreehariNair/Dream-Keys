<?php
session_start();
header('Content-Type: application/json');

$conn = new mysqli('mysql-6362f39-student-86e0.c.aivencloud.com', 'avnadmin', 'AVNS_ch4yIylQ2kinVTCYSxk', 'defaultdb',11316);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'DB connection failed']);
    exit();
}

$record_id = $_POST['property_id'] ?? '';

if (!$record_id) {
    echo json_encode(['status' => 'error', 'message' => 'No record ID provided']);
    exit();
}
$user = $_SESSION['username'];
$query = "DELETE FROM property WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $user);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
}
