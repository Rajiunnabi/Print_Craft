<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link rel="stylesheet" href="./css/pending_seller_request.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/common.css">
</head>

<body>
    

    <img src="image/bg.png" class="feature-img">
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div class="navbox">
                <ul>
                    <li><a href="all_user.php" target="_parent">View User-List</a></li>
                    <li><a href="pending_custom_order.php" target="_parent">Custom Orders</a></li>
                    <li><a href="pending_seller_request.php" target="_parent" class="feature-link" style="color: gold;">Seller Requests</a></li>
                    <li><a href="reportlist.php" target="_parent">View Reports</a></li>
                </ul>
            </div>
            <div>
                <a href="admin_control.php" target="_parent"  class="Login-btn">Return</a>
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
                <h4 class="text-center">Manage Seller Requests</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>See File</th>
                            <th>Reject</th>
                            <th>Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['search'])) {
                            $filtervalue = $_GET['search'];
                            $filterdata = "Select * from pendingseller where concat(name,company_name) like '%$filtervalue%'";
                            $filterdata_run = mysqli_query($conn, $filterdata);
                            if (mysqli_num_rows($filterdata_run) > 0) {
                                foreach ($filterdata_run as $row) {
                        ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['company_name']; ?></td>
                                        <td>
                                            <form action="tableusersoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="pendingsellerid" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="seefile" class="btn btn-danger">View Docs</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="tableusersoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="pendingsellerid" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="reject" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="tableusersoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="pendingsellerid" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="approve" class="btn btn-danger">Approve</button>
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
                            $filterdata = "Select * from pendingseller";
                            $filterdata_run = mysqli_query($conn, $filterdata);
                            if (mysqli_num_rows($filterdata_run) > 0) {
                                foreach ($filterdata_run as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['company_name']; ?></td>
                                        <td>
                                            <form action="tableusersoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="pendingsellerid" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="seefile" class="btn btn-danger">View Docs</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="tableusersoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="pendingsellerid" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="reject" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="tableusersoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="pendingsellerid" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="approve" class="btn btn-danger">Approve</button>
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