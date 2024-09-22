<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="./css/checkingsellerstyle.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    <?php

    if (!empty($_SESSION['message'])) {
        // Using htmlspecialchars to prevent XSS attacks
        $message = htmlspecialchars($_SESSION['message']);
        echo '<script type="text/javascript">';
        echo 'alert("' . $message . '");';
        echo '</script>';
        $_SESSION['message'] = "";
    }
    ?>

    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="Features.php" target="_parent">Features</a></li>
                    <li><a href="How_it_works.php" target="_parent">How it works</a></li>
                    <li><a href="About_us.php" target="_parent">About us</a></li>
                </ul>
            </div>
            <div>
                <a href="login.php" target="_parent" class="Login-btn">Return</a>
            </div>
        </nav>

        <form method="post" enctype="multipart/form-data" class="form">
            <h3>Seller Registration Query</h3>
            <label for="name" class="label">Name:</label>
            <input type="text" name="name" id="name" required value="" class="input"><br><br>
            <label for="companyname" class="label">Company Name:</label>
            <input type="text" name="companyname" id="companyname" required value="" class="input"><br><br>
            <label for="email" class="label">Email:</label>
            <input type="text" name="email" id="email" required value="" class="input"><br><br>
            <label for="password" class="label">Password:</label>
            <input type="password" name="password" id="password" required value="" class="input"><br><br>
            <label for="address" class="label">Address:</label>
            <input type="text" name="address" id="address" required value="" class="input"><br><br>
            <label for="phone" class="label">Phone:</label>
            <input type="text" name="phone" id="phone" required value="" class="input"><br><br>
            <div class="form-group">
                <label class="form-label" style="color: #0ef;">Area</label>
                <select class="custom-select" name="area">
                    <option>Chattagram</option>
                    <option>Dhaka</option>
                    <option>Khulna</option>
                    <option>Barishal</option>
                    <option>Sylhet</option>
                    <option>Rajshahi</option>
                    <option>Mymensingh</option>
                </select>
            </div>
            <br><br>
            <label for="image" class="label">Add Your Company Docs:</label>
            <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" value="" class="input"><br><br>
            <button type="submit" name="submit" class="button">Submit</button>
        </form>

        <?php
        require 'connection.php';
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $companyname = $_POST["companyname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $area = $_POST["area"];
            $file_name = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = 'pendingimages/' . $file_name;
            $checkname = "select * from pendingseller where name='$name'";
            $result = $conn->query($checkname);
            if ($result->num_rows > 0) {
                echo '<script type="text/javascript">';
                echo 'alert("This name already exists. Please choose a different name.");';
                echo '</script>';
            } else {
                $query = "insert into pendingseller (name,company_name,email,password,address,area,phone,image_url) values ('$name','$companyname','$email','$password','$address','$area','$phone','$folder')";
                mysqli_query($conn, $query);
                if (move_uploaded_file($tempname, $folder)) {
                    echo "<h2>File uploaded successfully</h2>";
                    exit(header("Location: login.php")); // Redirect upon successful upload
                } else {
                    echo "<h2>File upload unsuccessful</h2>";
                }
            }
        }
        ?>

    </div>

</body>

</html>