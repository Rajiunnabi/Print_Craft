<?php
session_start();
$_SESSION['active'] = 'customer';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./css/customerstyle.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="customer.php" target="_parent" class="feature-link" style="color: gold;">Home</a></li>
                    <li><a href="shopsellerlistforcustomer.php" target="_parent">Shop</a></li>
                    <li><a href="canvas3.php" target="_parent">Design</a></li>
                    <li><a href="need_help.php" target="_parent">Need Help?</a></li>
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
            <i class='bx bxs-user-circle'></i>
        </label>
        <div class="transparent-box">
            <ul>
                <li><a href="customer_profile.php" target="_parent">profile</a></li>
                <li><a href="customermyorder.php" target="_parent">My Orders</a></li>
                <li><a href="report.php" target="_parent">Report a bug</a></li>
                <li><a href="rate.php" target="_parent">Rate us</a></li>
            </ul>
        </div>

    </div>


    <img src="image/bg.png" class="feature-img">
</body>

</html>