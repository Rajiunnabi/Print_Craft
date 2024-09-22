<?php
session_start();
$_SESSION['active']='admin';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="./css/admin_control.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
</head>
<body>
    <img src="image/bg.png" class="feature-img">
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="all_user.php" target="_parent">View User-List</a></li>
                    <li><a href="pending_custom_order.php" target="_parent">Custom Orders</a></li>
                    <li><a href="pending_seller_request.php" target="_parent">Seller Requests</a></li>
                    <li><a href="reportlist.php" target="_parent">View Reports</a></li>
                </ul>
            </div>
            <div>
                <a href="webfront.php" target="_parent"  class="Login-btn">Log-Out</a>
            </div>
        </nav>
        <h1 style="color: red">All Notifications</h1>
       
    </div>
    
    
</body>
</html>
