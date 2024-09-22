<?php
session_start();
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = ['success' => false, 'message' => ''];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

// Handle file upload
$uploaded_image_path = '';
if (isset($_FILES['imageLoader'])) {
    $target_dir = 'shop/'; // Directory where images will be stored
    $target_file = $target_dir . basename($_FILES['imageLoader']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES['imageLoader']['tmp_name']);
    if ($check === false) {
        $response['message'] = 'File is not an image.';
        echo json_encode($response);
        exit();
    }

    // Check file size (max 5MB)
    if ($_FILES['imageLoader']['size'] > 5000000) {
        $response['message'] = 'Sorry, your file is too large.';
        echo json_encode($response);
        exit();
    }

    // Allow certain file formats
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($imageFileType, $allowedFormats)) {
        $response['message'] = 'Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed.';
        echo json_encode($response);
        exit();
    }

    // Attempt to move uploaded file
    if (!move_uploaded_file($_FILES['imageLoader']['tmp_name'], $target_file)) {
        $response['message'] = 'Sorry, there was an error uploading your file.';
        echo json_encode($response);
        exit();
    }
    
    $uploaded_image_path = $target_file;
}

// Insert product details into database
$productName = $_POST['productName'] ?? '';
$productPrice = $_POST['productPrice'] ?? '';
$productColors = $_POST['productColors'] ?? '';
$productSizes = $_POST['productSizes'] ?? '';

if (empty($productName) || empty($productPrice) || empty($productColors) || empty($productSizes)) {
    $response['message'] = 'Please fill in all required fields.';
    echo json_encode($response);
    exit();
}

$sql = "INSERT INTO products (sellerid,name, price, colors, sizes, image_path) VALUES (?, ?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    $response['message'] = 'Statement preparation failed: ' . $conn->error;
    echo json_encode($response);
    exit();
}
$sellerid=$_SESSION['sid'];
$stmt->bind_param("isssss", $sellerid,$productName, $productPrice, $productColors, $productSizes, $uploaded_image_path);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Product added successfully.';
} else {
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
