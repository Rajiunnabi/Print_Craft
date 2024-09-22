<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/my_orderstyle.css">
    <link rel="stylesheet" href="./css/nav.css">

</head>

<body>
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div>
                <a href="customermyorder.php" target="_parent" class="Login-btn"><i class='bx bxs-home'
                        style="font-size: 30px; margin-top: -10px;"></i></a>
            </div>
        </nav>
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
        <div class="container mt-5" style="position:relative; top:-5vh; left:6vw;">
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

        <div class="col-md 12" style="position:relative; top:-5vh; left:7vw;">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">MY ORDERS</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-header">
                                <th>Ordername</th>
                                <th>Delivery status</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Preview</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['search'])) {
                                $customerid = $_SESSION['cid'];
                                $filtervalue = $_GET['search'];
                                $filterdata = "Select * from orders where id='$customerid' and concat(name,deliverystatus,orderdate,deliverydate) like '%$filtervalue%'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr class="table-header">
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['deliverystatus']; ?></td>
                                            <td><?php echo $row['orderdate']; ?></td>
                                            <td><?php echo $row['deliverydate']; ?></td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="cedit" class="btn btn-danger">View Shirt</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="cdelete_btn" class="btn btn-danger">Delete</button>
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
                                $customerid = $_SESSION['cid'];
                                $filterdata = "Select * from orders where id='$customerid'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr class="table-header">
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['deliverystatus']; ?></td>
                                            <td><?php echo $row['orderdate']; ?></td>
                                            <td><?php echo $row['deliverydate']; ?></td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="cedit" class="btn btn-danger">View shirt</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="cdelete_btn" class="btn btn-danger">Delete</button>
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
                <li><a href="customermyorder.php" target="_parent" style="color: red;">My Orders</a></li>
                <li><a href="report.php" target="_parent">Report a bug</a></li>
                <li><a href="rate.php" target="_parent">Rate us</a></li>
            </ul>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>