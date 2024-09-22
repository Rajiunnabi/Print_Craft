<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
                            <th>Delivery status</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['search'])) {
                            $filtervalue = $_GET['search'];
                            $filterdata = "Select * from orders where concat(name,deliverystatus,orderdate,deliverydate) like '%$filtervalue%'";
                            $filterdata_run = mysqli_query($conn, $filterdata);
                            if (mysqli_num_rows($filterdata_run) > 0) {
                                foreach ($filterdata_run as $row) {
                        ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['deliverystatus']; ?></td>
                                        <td><?php echo $row['orderdate']; ?></td>
                                        <td><?php echo $row['deliverydate']; ?></td>
                                        <td>
                                            <form action="tableoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="delete_id" value="<?php echo $row['tshirtid']; ?>">
                                                <button type="submit" name="cdelete-btn" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="tableoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="delete_id" value="<?php echo $row['tshirtid']; ?>">
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
                            $filterdata = "Select * from orders";
                            $filterdata_run = mysqli_query($conn, $filterdata);
                            if (mysqli_num_rows($filterdata_run) > 0) {
                                foreach ($filterdata_run as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['deliverystatus']; ?></td>
                                        <td><?php echo $row['orderdate']; ?></td>
                                        <td><?php echo $row['deliverydate']; ?></td>
                                        <td>something</td>
                                        <td>
                                            <form action="tableoperation.php" method="post">
                                                <input type="hidden" class="form-control" name="delete_id" value="<?php echo $row['order_no']; ?>">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>