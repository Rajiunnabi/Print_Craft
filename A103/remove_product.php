<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = ['success' => false, 'message' => ''];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['id'] ?? '';

if (empty($productId)) {
    $response['message'] = 'Product ID is required.';
    echo json_encode($response);
    exit();
}

$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    $response['message'] = 'Statement preparation failed: ' . $conn->error;
    echo json_encode($response);
    exit();
}

$stmt->bind_param("i", $productId);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Product removed successfully.';
} else {
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>