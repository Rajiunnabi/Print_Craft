<?php
session_start();
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerid = $_SESSION['cid'];
    $productid = $_POST['productid'];

    // Remove the product from customer_cart
    $sql = "DELETE FROM customer_cart WHERE customerid = ? AND productid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customerid, $productid);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Product removed from cart successfully.';
    } else {
        $response['message'] = 'Error removing product from cart: ' . $stmt->error;
    }

    $stmt->close();
} else {
    $response['message'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>
