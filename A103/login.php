<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="./css/logstyle.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php
    session_start();
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
                <a href="webfront.php" target="_parent" class="Login-btn">Return</a>
            </div>
        </nav>
        <div class="wrapper">
            <span class="bg-animate"></span>
            <span class="bg-animate2"></span>

            <div class="form-box login">
                <h2 class="animation" style="--i:0; --j:21;">Login</h2>
                <form method="post" action="check.php">
                    <div class="input-box animation" style="--i:1; --j:22;">
                        <input type="text" name="username" required>
                        <label>Username</label>
                        <i class='bx bxs-user-circle'></i>
                    </div>
                    <div class="input-box animation" style="--i:2; --j:23;">
                        <input type="password" name="password" required>
                        <label>Password</label>
                        <i class='bx bxs-lock'></i>
                    </div>
                    <div class="input-box checkbox-box animation" style="--i:3; --j:24; height: 20px; width: 20px;">
                        <input type="checkbox" id="fromCompanyLogin" name="checkbox" value="1">
                        <label for="fromCompanyLogin" style="margin-top: 15px; margin-left: 30px;">Seller?</label>
                    </div>
                    <button type="submit" class="btn animation" name="login" style="--i:3; --j:24;">Login</button>
                    <div class="logreg-link animation" style="--i:4; --j:25;">
                        <p>New to PrintCraft ? <a href="#" class="register-link">Register Now!</a></p>
                    </div>
                </form>
            </div>
            <div class="info-text login">
                <h2 class="animation" style="--i:0; --j:20;">Welcome Back!</h2>
                <p class="animation" style="--i:1; --j:21;"> Let's get crafty with PrintCraft!</p>
            </div>

            <div class="form-box register">
                <h2 class="animation" style="--i:17; --j:0;">Sign Up</h2>
                <form method="post" action="check.php">
                    <div class="input-box animation" style="--i:18; --j:1;">
                        <input type="text" name="username" required>
                        <label>Username</label>
                        <i class='bx bxs-user-circle'></i>
                    </div>

                    <div class="input-box animation" style="--i:19; --j:2;">
                        <input type="text" name="email" required>
                        <label>Email</label>
                        <i class='bx bxs-envelope'></i>
                    </div>

                    <div class="input-box animation" style="--i:20; --j:3;">
                        <input type="password" name="password" required>
                        <label>Password</label>
                        <i class='bx bxs-lock'></i>
                    </div>

                    <button type="submit" class="btn animation" name="signup" style="--i:22; --j:5;">Sign Up</button>

                    <div class="logreg-link animation" style="--i:23; --j:6;">
                        <p>Got an Account? <a href="#" class="login-link">Login</a></p>
                        <p class="animation" style="--i:21; --j:4; color: red; margin-top:20px;">Register as a <a href="checkingseller.php" class="seller-link">Seller</a></p>
                    </div>
                </form>
            </div>

            <div class="info-text register">
                <h2 class="animation" style="--i:17; --j:0;">Hi There!</h2>
                <p class="animation" style="--i:18; --j:1;">Let's dive into your new journey with PrintCraft!</p>
            </div>

        </div>
    </div>

    <script src="./js/script.js"></script>

</body>

</html>
