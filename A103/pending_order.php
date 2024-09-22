<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="./css/seller_reportstyle.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .card {
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Soft shadow effect */
            background-color: #fff;
            /* White background */
        }

        .card-header {
            background-color: #007bff;
            /* Bootstrap primary color for header */
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* Light gray border */
        }

        .table th {
            background-color: #f0f0f0;
            /* Light gray background for table headers */
            color: #333;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Alternate row background color */
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            /* Hover row background color */
        }

        .btn {
            padding: 8px 16px;
            background-color: #28a745;
            /* Bootstrap success button color */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #218838;
            /* Darker shade of green on hover */
        }

        .btn-danger {
            background-color: #dc3545;
            /* Bootstrap danger button color */
        }

        .btn-danger:hover {
            background-color: #c82333;
            /* Darker shade of red on hover */
        }

        /* tableusers.css */

        .form-control {
            width: 30%;
            /* Make the input field width 100% of its container */
            padding: 12px;
            /* Add padding inside the input field */
            font-size: 16px;
            /* Increase font size for better readability */
            border: 1px solid #ced4da;
            /* Light gray border */
            border-radius: 4px;
            /* Rounded corners */
            box-sizing: border-box;
            /* Include padding and border in element's total width/height */
        }
    </style>

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
            <div>
                <a href="Seller-home.php" target="_parent" class="Login-btn"><i class='bx bxs-home'
                        style="font-size: 30px; margin-top: -10px;"></i></a>
            </div>
        </nav>

        <div class="container mt-5">
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
                    <h4 class="text-center">Shops orders</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Delete this order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['search'])) {
                                $filtervalue = $_GET['search'];
                                $sellerid = $_SESSION['sid'];
                                $filterdata = "Select * from customer_cart where sellerid='$sellerid' and concat(customerid,name,price) like '%$filtervalue%'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['customerid']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="customerid"
                                                        value="<?php echo $row['customerid']; ?>">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['productid']; ?>">
                                                    <button type="submit" name="deletesellerpendingorder"
                                                        class="btn btn-danger">Delete</button>
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
                                $sellerid = $_SESSION['sid'];
                                $filterdata = "Select * from customer_cart where sellerid='$sellerid'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['customerid']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="customerid"
                                                        value="<?php echo $row['customerid']; ?>">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['productid']; ?>">
                                                    <button type="submit" name="deletesellerpendingorder"
                                                        class="btn btn-danger">Delete</button>
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
                <li><a href="seller_profile.php" target="_parent">Profile</a></li>
                <li><a href="pending_order.php" target="_parent" style="color: red;">Pending Orders</a></li>
                <li><a href="seller_report.php" target="_parent">Report a Bug</a></li>
            </ul>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>