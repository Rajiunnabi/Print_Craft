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
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

// Handle POST request to add product to cart
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['name'] ?? '';
    $productPrice = $_POST['price'] ?? '';
    $productSize = $_POST['size'] ?? '';

    if (empty($productName) || empty($productPrice) || empty($productSize)) {
        $response['message'] = 'Please fill in all required fields.';
        echo json_encode($response);
        exit();
    }

    // Insert product details into customer_cart table
    $sellerid=$_SESSION['sid'];
    $customerid=$_SESSION['cid'];
    $productid=$_POST['productid'];
    $query="select * from customer_cart where customerid='$customerid' and productid='$productid'";
    $result=mysqli_query($conn,$query);
    if($result->num_rows==0){
        $sql = "INSERT INTO customer_cart (sellerid,customerid,productid,name, price, size) VALUES (?, ?, ?,?,?,?)";
        $stmt = $conn->prepare($sql);
         $stmt->bind_param("iiisss", $sellerid,$customerid,$productid,$productName, $productPrice, $productSize);
     
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Product added to cart successfully.';
    } else {
        $response['message'] = 'Error adding product to cart: ' . $stmt->error;
    }

    $stmt->close();
}else{
    $response['message']='You cannot add same product more than one';
}
} else {
    $response['message'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>
