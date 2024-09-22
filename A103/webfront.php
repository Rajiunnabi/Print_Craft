<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintCraft</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">

    <style>
        /* Additional styles specific to the login popup */
        .login-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .login-popup label {
            display: block;
            margin-bottom: 2vh;
        }

        .login-popup input[type="text"],
        .login-popup input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .login-popup button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .login-popup button:hover {
            background-color: #45a049;
        }

        /* Close button styles */
        .login-popup .close {
            position: absolute;
            top: 1vh;
            right: 1vw;
            font-size: 2vh;
            cursor: pointer;
            color: #aaa;
        }

        .login-popup .close:hover {
            color: black;
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
                    <li><a href="Features.php" target="_parent">Features</a></li>
                    <li><a href="How_it_works.php" target="_parent">How it works</a></li>
                    <li><a href="About_us.php" target="_parent">About us</a></li>
                </ul>
            </div>
            <div>
                <a href="login.php" target="_parent"  class="Login-btn">Log--in</a>
            </div>
        </nav>
        <div class="content">
            <h1>Design<br>Your<br> Mind</h1>
            <p>PrintCraft is an online shopping platform where YOU can Create, Customise and Buy T-shirts of Your Dream!
                Choose from the variety of collections we offer. Try it now!</p>
            <a href="login.php" target="_parent"   class="Login-btn">Try it</a>
        </div>
        <p style="color: #0ef; margin-left:92%">Login as <a href="#" id="admin-login-link" class="seller-link" style="color: red;">Admin</a></p>
    </div>
    <div id="login-popup" class="login-popup">
        <span class="close" onclick="closeLoginPopup()">&times;</span>
        <h2>Login as Admin</h2>
        <form id="admin-login-form">
            <label for="admin-id">Admin ID:</label>
            <input type="text" id="admin-id" name="admin-id" required>
            <label for="admin-password">Password:</label>
            <input type="password" id="admin-password" name="admin-password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="slider">
        <span style="--i:1;"><img src="image/image1.png" alt=""></span>
        <span style="--i:2;"><img src="image/image2.png" alt=""></span>
        <span style="--i:3;"><img src="image/image3.png" alt=""></span>
        <span style="--i:4;"><img src="image/image4.png" alt=""></span>
        <span style="--i:5;"><img src="image/image5.png" alt=""></span>
        <span style="--i:6;"><img src="image/image6.png" alt=""></span>
        <span style="--i:7;"><img src="image/image7.png" alt=""></span>
        <span style="--i:8;"><img src="image/image8.png" alt=""></span>
    </div>
    <script>
        // Function to close the login popup
        function closeLoginPopup() {
            document.getElementById('login-popup').style.display = 'none';
        }

        // Get the login popup and admin login link
        const adminLoginLink = document.getElementById('admin-login-link');

        // Show login popup when admin login link is clicked
        adminLoginLink.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('login-popup').style.display = 'block';
        });

        // Handle form submission for admin login
        const adminLoginForm = document.getElementById('admin-login-form');
        adminLoginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const adminId = document.getElementById('admin-id').value.trim();
            const adminPassword = document.getElementById('admin-password').value.trim();

            // Check admin credentials (example: admin id and password should match 'root')
            if (adminId === 'root' && adminPassword === 'root') {
                // Redirect to admin_control.php
                window.location.href = 'admin_control.php';
            } else {
                // Show error message (you can customize this part)
                alert('Incorrect username or password. Please try again.');
            }
        });
    </script>
</body>
</html>
