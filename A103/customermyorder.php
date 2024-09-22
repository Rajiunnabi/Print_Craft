<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./css/my_orderstyle.css">
    <link rel="stylesheet" href="./css/nav.css">

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
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div>
                <a href="customer.php" target="_parent" class="Login-btn"><i class='bx bxs-home'
                        style="font-size: 30px; margin-top: -10px;"></i></a>
            </div>
        </nav>


        <form method="post" action="customermyorderhandle.php">
            <button type="submit" class="btn animation" name="customdesign" style="--i:22; --j:5; ">Custom-Design
                Tshirts</button>
            <button type="submit" class="btn animation" name="ordersfromshop" style="--i:22; --j:5;">Orders from
                shops</button>
        </form>
    </div>






    <div class="profile_div">


        <input type="checkbox" id="myButton" class="hidden">
        <label for="myButton" class="button">
            <i class='bx bxs-user-circle'></i>
        </label>
        <div class="transparent-box">
            <ul>
                <li><a href="customer_profile.php" target="_parent">profile</a></li>
                <li><a href="customermyorder.php" target="_parent" style="color: red;">My Orders</a></li>
                <li><a href="report.php" target="_parent">Report a bug</a></li>
                <li><a href="rate.php" target="_parent">Rate us</a></li>
            </ul>
        </div>

    </div>


    <img src="image/bg.png" class="feature-img">






</body>

</html>