<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOXES</title>
    <link rel="stylesheet" href="./css/canvas3.css">
    <link rel="stylesheet" href="./css/grid-images2.css">
    <link rel="stylesheet" href="./css/nav2.css">
</head>
<body>

    <div class="head">
        <nav>
            <img src="Images/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="customer.php" target="_parent">Home</a></li>
                    <li><a href="shopsellerlistforcustomer.php" target="_parent">Shop</a></li>
                    <li><a href="canvas3.php" target="_parent" class="feature-link" style="color: gold;">Design</a></li>
                    <li><a href="need_help.php" target="_parent">Need Help?</a></li>
                </ul>
            </div>
            <div>
                <a href="webfront.php" target="_parent" class="Login-btn">Log - out</a>
            </div>  

        </nav>
        <div class="profile_div">
            <input type="checkbox" id="myButton" class="hidden">
            <label for="myButton" class="button">
                <i class='bx bxs-user-circle'></i>
            </label>
            <div class="transparent-box">
                <ul>
                    <li><a href="customer_profile.php" target="_parent">profile</a></li>
                    <li><a href="my_order.php" target="_parent">My Orders</a></li>
                    <li><a href="report.php" target="_parent">Report a bug</a></li>
                    <li><a href="rate.php" target="_parent">Rate us</a></li>
                </ul>
            </div>  
        </div>
    </div>


    <div class="work">
        <div class="zero">
            <button id="toggleButton">Select Design</button>    
            <div class="grid-container">
                <div class="grid-item"><img src="shop/1.png" alt="Image 1"></div>
                <div class="grid-item"><img src="shop/2.png" alt="Image 2"></div>
                <div class="grid-item"><img src="shop/3.png" alt="Image 3"></div>
                <div class="grid-item"><img src="shop/4.png" alt="Image 4"></div>
                <div class="grid-item"><img src="shop/5.png" alt="Image 5"></div>
                <div class="grid-item"><img src="shop/6.png" alt="Image 6"></div>
                <div class="grid-item"><img src="shop/7.png" alt="Image 7"></div>
                <div class="grid-item"><img src="shop/8.png" alt="Image 8"></div>
                <div class="grid-item"><img src="shop/9.png" alt="Image 9"></div>
                <div class="grid-item"><img src="shop/10.png" alt="Image 10"></div>
                <div class="grid-item"><img src="shop/11.png" alt="Image 11"></div>
                <div class="grid-item"><img src="shop/12.png" alt="Image 12"></div>
            </div>
            <button id="toggleButton2">WordArts</button>
            <div class="grid-container2">
                <div class="grid-item2"><img src="Wordart/1.png" alt="Image 1"></div>
                <div class="grid-item2"><img src="Wordart/2.png" alt="Image 2"></div>
                <div class="grid-item2"><img src="Wordart/3.png" alt="Image 3"></div>
                <div class="grid-item2"><img src="Wordart/4.png" alt="Image 4"></div>
                <div class="grid-item2"><img src="Wordart/5.png" alt="Image 5"></div>
                <div class="grid-item2"><img src="Wordart/6.png" alt="Image 6"></div>
                <div class="grid-item2"><img src="Wordart/7.png" alt="Image 7"></div>
                <div class="grid-item2"><img src="Wordart/8.png" alt="Image 8"></div>
                <div class="grid-item2"><img src="Wordart/9.png" alt="Image 9"></div>
                <div class="grid-item2"><img src="Wordart/10.png" alt="Image 10"></div>
                <div class="grid-item2"><img src="Wordart/11.png" alt="Image 11"></div>
            </div>
    
            <div class="img1">
                <label for="upload-icon" class="breh">
                    <img class="icon" src="Images/Upload.png" style="cursor: pointer;">
                    <br><h4 style="position: absolute; top:90.5vh; left:6.5vw;">Upload</h4>
                </label>
                <input type="file" id="upload-icon" accept="image/*">
            </div>
            
        </div>

        <div class="one">
            <div class="product">
                <canvas id="canvas"></canvas>
                <div class="color"></div>
                <img src="Images/p1.png" class="img2"> 
                <img src="Images/p4.png" class="img3">
            </div>
        </div>

        <div class="two">
            <div class="product1">
                <input type="color" class="color-input" value="#ffffff" />
            </div>
            <button id="clr-btn" style="margin:1px; color:black; border-radius: 2em;">Choose Color</button><br>
            <div class="COLORS">
                <button class="clr" style="background-color: #ffffff;" value="#ffffff"></button>
                <button class="clr" style="background-color: #000000;" value="#000000"></button>
                <button class="clr" style="background-color: #0000ff;" value="#0000ff"></button>
                <button class="clr" style="background-color: #b0ffb0;" value="#b0ffb0"></button>
                <button class="clr" style="background-color: #ff0000;" value="#ff0000"></button>
                <button class="clr" style="background-color: #1f3f5f;" value="#1f3f5f"></button>
                <button class="clr" style="background-color: #1b9e6a;" value="#1b9e6a"></button>
                <button class="clr" style="background-color: #4e0202;" value="#4e0202"></button>
                <button class="clr" style="background-color: #4f2040;" value="#4f2040"></button>
                <button class="clr" style="background-color: #6f7f8f;" value="#6f7f8f"></button>
                <button class="clr" style="background-color: #9f8ff3;" value="#9f8ff3"></button>
                <button class="clr" style="background-color: #0f0f3f;" value="#0f0f3f"></button>
                <button class="clr" style="background-color: #616;" value="#616"></button>
                <button class="clr" style="background-color: rgb(255, 182, 188);" value="rgb(255,182,188)"></button>
                <button class="clr" style="background-color: rgb(255, 130, 0);" value="rgb(255, 130, 0)"></button>
                <button class="clr" style="background-color: rgb(177, 246, 255);" value="rgb(177, 246, 255)"></button>
                <button class="clr" style="background-color: rgb(255, 251, 0);" value="rgb(250, 251, 0)"></button>
                <button class="clr" style="background-color: rgb(111, 170, 247);" value="rgb(111, 170, 247)"></button>
                <button class="clr" style="background-color: rgb(255, 138, 138);" value="rgb(255, 138, 138)"></button>
                <button class="clr" style="background-color: rgb(255, 214, 253);" value="rgb(255, 214, 253)"></button>
            </div><br><br>
            <form style="font-size: 1.5vw;">
                <label style="font-size:20px; height:50%; color:white;">Select Size</label>
                <select name="size" style="font-size: 20px; display:flex; margin:auto; justify-content:center; width:13vh; height:6vh; border-radius: 0.5em;">
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="3XL">3XL</option>
                </select>
            </form>
            
            <div class="quantity" style="margin:2vh;">
                <label for="quantityInput" style="cursor:auto; color:white;">Quantity:</label>
                <input type="number" id="quantityInput" min="1" value="1" style="margin-top:2vh; width:15vh; height:4.5vh; border-radius: 0.5em;">
            </div>

            <div class="price-display" style="margin-left:-1.1vw; position: relative;">
                <label for="priceInput" style="cursor:auto; color:white;">Total Price:</label>
                <input type="text" id="priceInput" readonly style="width:15vh; margin-top:2vh; height:4.5vh; border-radius: 0.5em;" value="100 Tk">
            </div>

            <button id="confirmButton" style="margin-top:5vh;">Confirm</button>

            <!--<button class="print" style="margin:2vh;">PRINT</button>-->
    
        </div>
    </div>

    <script src="./js/Box.js"></script>   

</body>
</html>












































