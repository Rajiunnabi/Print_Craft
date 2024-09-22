<?php
session_start();
$_SESSION['active']='seller';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./css/seller-homestyle.css">
    <link rel="stylesheet" href="./css/nav.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                 <li><a href="Seller-home.php" target="_parent" class="feature-link" style="color: gold;">Home</a></li>
                 <li><a href="sellershop.php" target="_parent">Manage Shop</a></li>
                </ul>
            </div>
            <div>
                <a href="webfront.php" target="_parent" class="Login-btn">Log--out</a>
            </div>
            
        </nav>
    </div>
    <div class="profile_div">


        <input type="checkbox" id="myButton" class="hidden">
        <label for="myButton" class="button">
            <i class='bx bxs-user-circle' ></i>
        </label>
        <div class="transparent-box">
            <ul>
            <li><a href="seller_profile.php" target="_parent">Profile</a></li>
            <li><a href="pending_order.php" target="_parent">Pending Orders</a></li>
            <li><a href="seller_report.php" target="_parent">Report a Bug</a></li>
            </ul>
        </div>

    </div>


    <img src="image/bg.png" class="feature-img">
</body>
</html>
