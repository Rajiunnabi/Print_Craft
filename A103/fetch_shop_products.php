<?php

session_start();
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response = ['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error];
    echo json_encode($response);
    exit();
}

$size = isset($_GET['size']) ? $_GET['size'] : '';

$query = "SELECT * FROM products";
if (!empty($size)) {
    $query .= " WHERE sizes = '$size'";
}

$result = $conn->query($query);
$products = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode([
    'success' => true,
    'products' => $products
]);

$conn->close();
?>
