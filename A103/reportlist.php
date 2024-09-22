<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="./css/reportlist.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Additional styles for report list */
        /* reportlist.css */

        /* Scrollbar Styles */
        .features-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5%;
            margin-top: 2%;
            /* Adjust this margin as needed */
            max-height: 60vh;
            /* Limit height to 80% of viewport height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        /* Track */
        .features-container::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        /* Handle */
        .features-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        /* Handle on hover */
        .features-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Firefox scrollbar */
        .features-container {
            scrollbar-width: thin;
            scrollbar-color: transparent transparent;
        }

        .features-container::-moz-scrollbar-track {
            background-color: #f1f1f1;
        }

        .features-container::-moz-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        .features-container::-moz-scrollbar-thumb:hover {
            background: #555;
        }

        /* Additional styles for report items */
        .report-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 3%;
            border-radius: 10px;
            margin-bottom: 20px;
            width: 80%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .report-item:hover {
            transform: translateY(-5px);
        }

        .report-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #fff;
        }

        .report-details {
            font-size: 16px;
            color: #ddd;
        }
    </style>
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
                    <li><a href="reportlist.php" target="_parent" class="feature-link"
                            style="color: gold;">View
                            Reports</a></li>
                </ul>
            </div>
            <div>
                <a href="admin_control.php" target="_parent" class="Login-btn">Return</a>
            </div>
        </nav>

        <div class="features-container">
            <?php
            $query = "SELECT * FROM report";
            $result = mysqli_query($conn, $query);
            $ulstringArray = [];
            $ulstringArray1=[];
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                if ($row['seller']) {
                    $inner_query = "SELECT * FROM sellers WHERE id='$id'";
                } else {
                    $inner_query = "SELECT * FROM users WHERE id='$id'";
                }
                $inresult = mysqli_query($conn, $inner_query);
                $row1 = mysqli_fetch_assoc($inresult);
                $name = "(" . $row1['name'] . ") : ";
                $side = ($row['seller'] == 1) ? "Seller " : "Customer ";
                $description = $row['description'];
                $ulstring=$side.$name.$description;
                $ulstringArray[] = $ulstring;
                $ulstringArray1[]= $row['title'];
            }
            ?>
            <?php
            $count = count($ulstringArray);
            for($i=$count-1;$i>=0;$i--){
            ?>
            <div class="report-item">
                <h2 class="report-title" style="color:#0ef;"><?php echo $ulstringArray1[$i]; ?></h2>
                <p class="report-details"><?php echo $ulstringArray[$i]; ?></p>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
