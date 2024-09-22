<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Shop</title>

    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/sellershop.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <img src="image/bg.png" class="feature-img">
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="Seller-home.php" target="_parent">Home</a></li>
                    <li><a href="sellershop.php" target="_parent" class="feature-link" style="color: gold;">Manage
                            Shop</a></li>
                </ul>
            </div>
            <div>
                <a href="Seller-home.php" target="_parent" class="Login-btn"><i class='bx bxs-home'
                        style="font-size: 30px; margin-top: -10px;"></i></a>
            </div>
        </nav>




        <div class="company-name">
            <h1><?php echo $_SESSION['scompany_name']; ?></h1>


        </div>






        <div class="grid-container" id="grid-container">
            <!-- Initial card with the '+' sign -->
            <div class="card">
                <div class="image-container">
                    <a href="sellerstyle.html" class="plus-sign">+</a>
                </div>
                <div class="details">
                    <p>Available Colors: <span class="color"></span></p>
                    <p>Size: <span class="size"></span></p>
                    <p>Price: <span class="price"></span></p>
                    <p>Name: <span class="name"></span></p>
                </div>
            </div>
        </div>
        



    </div>

    <div class="profile_div">
        <input type="checkbox" id="myButton" class="hidden">
        <label for="myButton" class="button">
            <i class='bx bxs-user-circle'></i>
        </label>
        <div class="transparent-box">
            <ul>
                <li><a href="seller_profile.php" target="_parent">Profile</a></li>
                <li><a href="pending_order.php" target="_parent">Pending Orders</a></li>
                <li><a href="seller_report.php" target="_parent">Report a Bug</a></li>
            </ul>
        </div>
    </div>





    <script src="./js/sellershop.js"></script>
</body>

</html>