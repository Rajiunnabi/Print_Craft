<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link rel="stylesheet" href="./css/pending_custom_order.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">

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

<body>
    <div class="hero">
        <!-- <img src="image/bg.png" class="feature-img"> -->
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="all_user.php" target="_parent">View User-List</a></li>
                    <li><a href="pending_custom_order.php" target="_parent" class="feature-link"
                            style="color: gold;">Custom Orders</a></li>
                    <li><a href="pending_seller_request.php" target="_parent">Seller Requests</a></li>
                    <li><a href="reportlist.php" target="_parent">View Reports</a></li>
                </ul>
            </div>
            <div>
                <a href="pending_custom_order.php" target="_parent" class="Login-btn">Return</a>
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
                    <h4 class="text-center">MY ORDERS</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ordername</th>
                                <th>Order Date</th>
                                <th>Delivery Status</th>
                                <th>Order Placed</th>
                                <th>Delivery Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['search'])) {
                                $customerid = $_SESSION['pendingcustomerorderid'];
                                $filtervalue = $_GET['search'];
                                $filterdata = "Select * from orders where id='$customerid' and concat(name,deliverystatus,orderdate,deliverydate) like '%$filtervalue%'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        $deliverystatus = $row['deliverystatus'];
                                        $orderplaced = $row['orderplaced'];
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['orderdate'] ?></td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="deliverystatus"
                                                        class="btn btn-danger"><?php echo $deliverystatus ?></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="orderplaced"
                                                        class="btn btn-danger"><?php echo $orderplaced ?></button>
                                                </form>
                                            </td>
                                            <td><?php echo $row['deliverydate'] ?></td>
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
                            } else {
                                $customerid = $_SESSION['pendingcustomerorderid'];
                                $filterdata = "Select * from orders where id='$customerid'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        $deliverystatus = $row['deliverystatus'];
                                        $orderplaced = $row['orderplaced'];
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['orderdate'] ?></td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="deliverystatus"
                                                        class="btn btn-danger"><?php echo $deliverystatus ?></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="tableoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['tshirtid']; ?>">
                                                    <button type="submit" name="orderplaced"
                                                        class="btn btn-danger"><?php echo $orderplaced ?></button>
                                                </form>
                                            </td>
                                            <td><?php echo $row['deliverydate'] ?></td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>