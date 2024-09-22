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

// Fetch all products from database
$id=$_SESSION['sid'];
$sql = "SELECT * FROM products where sellerid='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'colors' => $row['colors'],
            'sizes' => $row['sizes'],
            'image_path' => $row['image_path']
        ];
    }
    $response = ['success' => true, 'products' => $products];
} else {
    $response = ['success' => false, 'message' => 'No products found.'];
}

$conn->close();

echo json_encode($response);
?>
