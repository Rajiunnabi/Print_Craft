<?php
session_start();
require 'connection.php';

if (isset($_GET['product_name'])) {
    $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);
    
    // Query the products table to get the image path
    $query = "SELECT image_path FROM products WHERE name = '$product_name'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        $image_path = $row['image_path'];
    } else {
        echo "No image found for this product.";
        exit();
    }
} else {
    echo "No product name provided.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Image</title>
    <link rel="stylesheet" href="./css/preview.css">
</head>
<body>
    <div class="product" style="background-color:white; display:flex; align-items: center; justify-content: center;">    
        <canvas id="previewCanvas"></canvas>
        <div class="color"></div>
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" style="max-width: 100%; height: auto;">
    </div>
    
</body>
</html>
