<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report a Bug</title>
    <link rel="stylesheet" href="./css/seller_reportstyle.css">
    <link rel="stylesheet" href="./css/nav.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<img src="image/bg.png" class="feature-img">
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div>
                <a href="Seller-home.php" target="_parent" class="Login-btn"><i class='bx bxs-home' style="font-size: 30px; margin-top: -10px;"></i></a>
            </div>
        </nav>
        

        <form method="post" action="handlingreports.php" enctype="multipart/form-data" class="form">
            <h3>Please Fill the Query</h3>
            
            <label for="companyname" class="label">Report Topic:</label>
            <input type="text" name="sreporttopic" id="sreporttopic" required value="" class="input"><br><br>


            <label for="address" class="label">Description:</label>
            <textarea name="sreportdescription" id="sreportdescription" required class="largeinput"></textarea>



            <button type="submit" name="sreportsubmit" class="button">Submit</button>
        </form>


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
                <li><a href="seller_report.php" target="_parent" style="color: red;">Report a Bug</a></li>
            </ul>
        </div>

    </div>

</body>
</html>
