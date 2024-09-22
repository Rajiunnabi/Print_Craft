<?php
require 'connection.php';
session_start();

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $phone = $_POST['phone'];
    $query = "select * from users where name='$name'";
    $result = $conn->query($query);
    if ($_POST['name'] == "" || $_POST['name'] == $_SESSION['cname'] || $result->num_rows == 0) {

        if (!empty($new_password)) {
            if ($new_password == $repeat_new_password) {
                if ($current_password == $_SESSION['cpassword']) {
                    $_SESSION['cpassword'] = $new_password;
                } else {
                    $_SESSION['message'] = "Sorry your current password did not match";
                    if (headers_sent()) {
                        die("Redirect failed. Please click on this link: <a href=...>");
                    } else {
                        exit(header("Location: customer_profile.php"));
                    }
                }
            } else {
                $_SESSION['message'] = "Sorry Your repeat Password did not match";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=...>");
                } else {
                    exit(header("Location: customer_profile.php"));
                }
            }
        }

        if (!empty($name)) {
            $_SESSION['cname'] = $name;
        }

        if (!empty($email)) {
            $_SESSION['cemail'] = $email;
        }


        if (!empty($address)) {
            $_SESSION['caddress'] = $address;
        }

        if (!empty($area)) {
            $_SESSION['carea'] = $area;
        }

        if (!empty($phone)) {
            $_SESSION['cphone'] = $phone;
        }

        $stmt = $conn->prepare("UPDATE users SET name= ?, email = ?, password = ?, address = ?, area = ?, phone = ? WHERE id= ?");
        if ($stmt) {
            $stmt->bind_param("ssssssi", $_SESSION['cname'], $_SESSION['cemail'], $_SESSION['cpassword'], $_SESSION['caddress'], $_SESSION['carea'], $_SESSION['cphone'], $_SESSION['cid']);
            if ($stmt->execute()) {
                echo "Profile updated successfully.";
                $_SESSION['nexist'] = 0;
            } else {
                echo "Error executing query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
        $conn->close();

    } else {
        $_SESSION['message'] = "Sorry this Name already exist in Database";
    }
    if (headers_sent()) {
        die("Redirect failed. Please click on this link: <a href=...>");
    } else {
        exit(header("Location: customer_profile.php"));
    }

}

if (isset($_POST['sellersave'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];
    if (!empty($new_password)) {
        if ($new_password == $repeat_new_password) {
            if ($current_password == $_SESSION['spassword']) {
                $_SESSION['spassword'] = $new_password;
            } else {
                $_SESSION['message'] = "Sorry your current password did not match";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=...>");
                } else {
                    exit(header("Location: seller_profile.php"));
                }
            }
        } else {
            $_SESSION['message'] = "Sorry Your repeat Password didnot match";
            if (headers_sent()) {
                die("Redirect failed. Please click on this link: <a href=...>");
            } else {
                exit(header("Location: seller_profile.php"));
            }
        }
    }
    if (headers_sent()) {
        die("Redirect failed. Please click on this link: <a href=...>");
    } else {
        exit(header("Location: seller_profile.php"));
    }

}



?>