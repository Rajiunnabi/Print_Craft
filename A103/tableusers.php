<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/tableusers.css">

    
</head>

<body>

    <div class="hero">

        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="all_user.php" target="_parent" class="feature-link" style="color: gold;">View User-List
                        </a></li>
                    <li><a href="pending_custom_order.php" target="_parent">Custom Orders</a></li>
                    <li><a href="pending_seller_request.php" target="_parent">Seller Requests</a></li>
                    <li><a href="reportlist.php" target="_parent">View Reports</a></li>
                </ul>
            </div>
            <div>
                <a href="all_user.php" target="_parent" class="Login-btn">Return</a>
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
                    <h4 class="text-center">Manage Users</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Area</th>
                                <th>Delete Him</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['search'])) {
                                $filtervalue = $_GET['search'];
                                $user = $_SESSION['users'];
                                $filterdata = "Select * from $user where concat(id,name,area) like '%$filtervalue%'";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['area']; ?></td>
                                            <td>
                                                <form action="tableusersoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="udelete-btn" class="btn btn-danger">Delete</button>
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
                                $user = $_SESSION['users'];
                                $filterdata = "Select * from $user";
                                $filterdata_run = mysqli_query($conn, $filterdata);
                                if (mysqli_num_rows($filterdata_run) > 0) {
                                    foreach ($filterdata_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['area']; ?></td>
                                            <td>
                                                <form action="tableusersoperation.php" method="post">
                                                    <input type="hidden" class="form-control" name="delete_id"
                                                        value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="udelete-btn" class="btn btn-danger">Delete</button>
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