<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Lists</title>
    <link rel="stylesheet" href="./css/all_user.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /* my_orderstyle.css */

        /* Add general button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            /* Rounded corners */
            cursor: pointer;
            outline: none;
            position: relative;
            overflow: hidden;
            background-color: #3498db;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Add animation styles */
        .btn.animation {
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        /* Hover effect */
        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        /* Custom-Design Tshirts button specific styles */
        .btn[name="customdesign"] {
            background-color: #e74c3c;
        }

        /* Orders from shops button specific styles */
        .btn[name="ordersfromshop"] {
            background-color: #27ae60;
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
                    <li><a href="all_user.php" target="_parent" class="feature-link" style="color: gold;">View
                            User-List</a></li>
                    <li><a href="pending_custom_order.php" target="_parent">Custom Orders</a></li>
                    <li><a href="pending_seller_request.php" target="_parent">Seller Requests</a></li>
                    <li><a href="reportlist.php" target="_parent">View Reports</a></li>
                </ul>
            </div>
            <div>
                <a href="admin_control.php" target="_parent" class="Login-btn">Return</a>
            </div>
        </nav>

        <form method="post" action="userlist.php" class="org">
            <button type="submit" class="btn animation" name="customerlist" style="margin-left:40%;--i:22; --j:5; ">View Customers</button>
            <button type="submit" class="btn animation" name="sellerlist" style="--i:22; --j:5;">View Sellers</button>
        </form>

    </div>

</body>

</html>