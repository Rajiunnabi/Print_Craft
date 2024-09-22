<?php
session_start();
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}


$tshirtid = $_SESSION['tshirtid'];
$result = $conn->query("SELECT * FROM design2 WHERE id='$tshirtid'");

if ($result->num_rows > 0) {
    $design = $result->fetch_assoc();
    
    $orderResult = $conn->query("SELECT quantity, totalPrice FROM orders WHERE tshirtid='$tshirtid'");
    
    if ($orderResult->num_rows > 0) {
        $orderData = $orderResult->fetch_assoc();
        $design['quantity'] = $orderData['quantity'];
        $design['totalPrice'] = $orderData['totalPrice'];
    } else {
        echo json_encode(['success' => false, 'message' => 'No order data found for this t-shirt']);
        $conn->close();
        exit();
    }

    $design['size'] = $design['size']; 

    $image_data = json_decode($design['image_data'], true);
    
    $uploaded_image_paths = json_decode($design['uploaded_image_path'], true);
    
    $imageData = [];

    //ensuring the number of image paths matches the number of image data entries
    if (count($image_data) === count($uploaded_image_paths)) {
        foreach ($image_data as $index => $imgData) {
            $imgData['src'] = $uploaded_image_paths[$index];
            $imageData[] = $imgData;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Mismatch between image data and image paths']);
        $conn->close();
        exit();
    }

    $design['imageData'] = $imageData;
    echo json_encode(['success' => true, 'data' => $design]);
} else {
    echo json_encode(['success' => false, 'message' => 'No design data found']);
}

$conn->close();
?>
