<?php
session_start();
$_SESSION['active'] = 'customer';
require 'connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/tableusers.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body style="display:flex;">
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
                    <li><a href="customer.php" target="_parent">Home</a></li>
                    <li><a href="shopsellerlistforcustomer.php" target="_parent" class="feature-link"
                            style="color: gold;">Shop</a></li>
                    <li><a href="canvas3.php" target="_parent">Design</a></li>
                    <li><a href="need_help.php" target="_parent">Need
                            Help?</a></li>
                </ul>
            </div>
            <div>
                <a href="webfront.php" target="_parent" class="Login-btn">Log--out</a>
            </div>

        </nav>

        <div class="container mt-5" style="justify-content:center;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="<?php if (isset($_GET['search'])) {
                                echo $_GET['search'];
                            } ?>" name="search" placeholder="Search here...">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="col-md 12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">View Shops</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Name</th>
                                <th>Area</th>
                                <th>View Shop</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['search'])) {
                                $filtervalue = $_GET['search'];
                                $filterdata = "Select * from sellers where concat(company_name,name,area) like '%$filtervalue%'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['company_name']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['area']; ?></td>
                                            <td>
                                                <form action="tableusersoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="viewshopseller" class="btn btn-danger">Shop</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4">No Record Found</td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                $filterdata = "Select * from sellers";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['company_name']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['area']; ?></td>
                                            <td>
                                                <form action="tableusersoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="viewshopseller" class="btn btn-danger">Shop</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4">No Record Found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
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
                <li><a href="customer_profile.php" target="_parent">profile</a></li>
                <li><a href="customermyorder.php" target="_parent">My Orders</a></li>
                <li><a href="report.php" target="_parent">Report a bug</a></li>
                <li><a href="rate.php" target="_parent">Rate us</a></li>
            </ul>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>