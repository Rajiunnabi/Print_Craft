<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your profile</title>
    <link rel="stylesheet" href="./css/seller_profilestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/nav.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #F02A00;
        }
    </style>
</head>

<body style="background: #081b29;display: flex;">
<?php
    if (!empty($_SESSION['message'])) {
        $message = htmlspecialchars($_SESSION['message']);
        echo '<script type="text/javascript">';
        echo 'alert("' . $message . '");';
        echo '</script>';
        $_SESSION['message'] = "";
    }
    ?>
    <img src="image/bg.png" class="feature-img">
    <div class="hero">
        <nav>
            <img src="image/bg2.png" class="logo">
            <div>
                <a href="Seller-home.php" target="_parent" class="Login-btn"><i class='bx bxs-home' style="font-size: 30px; margin-top: -10px;"></i></a>
            </div>
        </nav>



        <div class="container light-style flex-grow-1 container-p-y" style="margin-left: 20%;">
            <h4 class="font-weight-bold py-3 mb-4" style="color: aqua;">
                Account settings
            </h4>
            <div class="card overflow-hidden" style="background-color: transparent;
            border: 2px solid #0ef;
            box-shadow: 0 0 25px #0ef;
            width: 70%;">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links" style="background-color: #081b29;
                        border: 2px solid #0ef;
                        box-shadow: 0 0 25px #0ef;
                        width: 90%;">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general" style="background-color: #0ef; border: 2px solid #081b29;
                        box-shadow: 0 0 25px #0ef;">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password" style="background-color: #0ef; border: 2px solid #081b29;
                        box-shadow: 0 0 25px #0ef;">Change password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info" style="background-color: #0ef; border: 2px solid #081b29;
                        box-shadow: 0 0 25px #0ef;">Info</a>

                        </div>
                    </div>

                    <form method="POST" action="profile_handler.php" style="width:50%;">
                        <div class="col-md-9">
                            <div class="tab-content">



                                <div class="tab-pane fade active show" id="account-general">



                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Name</label>
                                            <input type="text" class="form-control" value style="background-color: transparent;" placeholder="<?php echo $_SESSION['sname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">E-mail</label>
                                            <input type="text" class="form-control mb-1" value style="background-color: transparent;" placeholder="<?php echo $_SESSION['semail']; ?>">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Company Name</label>
                                            <input type="text" class="form-control mb-1" value style="background-color: transparent;" placeholder="<?php echo $_SESSION['scompany_name']; ?>">

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-change-password">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Current password</label>
                                            <input type="password" class="form-control" name="current_password" style="background-color: transparent;">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">New password</label>
                                            <input type="password" class="form-control" name="new_password" style="background-color: transparent;">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Repeat new password</label>
                                            <input type="password" class="form-control" name="repeat_new_password" style="background-color: transparent;">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-info">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Address</label>
                                            <textarea class="form-control" rows="5" style="background-color: transparent;" placeholder="<?php echo $_SESSION['saddress']; ?>"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Area</label>
                                            <select class="custom-select">
                                                <option <?php echo ($_SESSION['sarea'] == 'Chattagram') ? 'selected' : ''; ?>>Chattagram</option>
                                                <option <?php echo ($_SESSION['sarea'] == 'Dhaka') ? 'selected' : ''; ?>>Dhaka</option>
                                                <option <?php echo ($_SESSION['sarea'] == 'Khulna') ? 'selected' : ''; ?>>Khulna</option>
                                                <option <?php echo ($_SESSION['sarea'] == 'Barishal') ? 'selected' : ''; ?>>Barishal</option>
                                                <option <?php echo ($_SESSION['sarea'] == 'Sylhet') ? 'selected' : ''; ?>>Sylhet</option>
                                                <option <?php echo ($_SESSION['sarea'] == 'Rajshahi') ? 'selected' : ''; ?>>Rajshahi</option>
                                                <option <?php echo ($_SESSION['sarea'] == 'Mymensingh') ? 'selected' : ''; ?>>Mymensingh</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body pb-2">
                                        <h3 class="mb-4" style="color: #0ef;">Contacts</h3>
                                        <div class="form-group">
                                            <label class="form-label" style="color: #0ef;">Phone</label>
                                            <input type="text" class="form-control" value style="background-color: transparent;" placeholder="<?php echo $_SESSION['sphone']; ?>">
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary" style="margin-right: 30%;" name="sellersave">Save changes</button>&nbsp;
                        </div>
                    </form>
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
                <li><a href="seller_profile.php" target="_parent" style="color: red;">Profile</a></li>
                <li><a href="pending_order.php" target="_parent">Pending Orders</a></li>
                <li><a href="seller_report.php" target="_parent">Report a Bug</a></li>
            </ul>
        </div>

    </div>



    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    </script>
</body>

</html>