<?php
require 'connection.php';
session_start();
if (isset($_POST['cdelete_btn'])) {
  $tshirtid = mysqli_real_escape_string($conn, $_POST['delete_id']);

  $query1 = "DELETE FROM design2 WHERE id='$tshirtid'";
  $result1 = mysqli_query($conn, $query1);

  $query = "SELECT * FROM orders WHERE tshirtid='$tshirtid'";
  $result = mysqli_query($conn, $query);

  if ($result && $result1) {
    $row = mysqli_fetch_assoc($result);
    if ($row && $row['orderplaced'] == "NO") {
      $query1 = "DELETE FROM orders WHERE tshirtid='$tshirtid'";
      $query_run = mysqli_query($conn, $query1);
      if ($query_run) {
        $_SESSION['message'] = "Data deleted successfully";
      } else {
        $_SESSION['message'] = "Data delete unsuccessful";
      }
    } else {
      $_SESSION['message'] = "Order is already placed. Cannot delete this order";
    }
  } else {
    $_SESSION['message'] = "Error: " . mysqli_error($conn);
  }

  $active = $_SESSION['active'];

  if ($active == "admin") {
    if (headers_sent()) {
      die("Redirect failed. Please click on this link: <a href=...>");
    } else {
      exit(header("Location: pending_custom_ordertable.php"));
    }
  } else {
    if (headers_sent()) {
      die("Redirect failed. Please click on this link: <a href=...>");
    } else {
      exit(header("Location: my_order.php"));
    }
  }
}
if (isset($_POST['cedit'])) {
  $order_no = $_POST['delete_id'];
  $_SESSION['tshirtid'] = $order_no;
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: preview.php"));
  }
}

if (isset($_POST['adminvieworders'])) {
  $id = $_POST['delete_id'];
  $_SESSION['pendingcustomerorderid'] = $id;
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: pending_custom_ordertable.php"));
  }
}

if (isset($_POST['deliverystatus'])) {
  $tshirtid = $_POST['delete_id'];
  if ($_SESSION['deliverystatus'] == "NOT DELIVERED")
    $_SESSION['deliverystatus'] = "DELIVERED";
  else
    $_SESSION['deliverystatus'] = "NOT DELIVERED";
  $deliverystatus = $_SESSION['deliverystatus'];
  $query = "update orders set deliverystatus='$deliverystatus' where tshirtid=$tshirtid";
  mysqli_query($conn, $query);
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: pending_custom_ordertable.php"));
  }
}

if (isset($_POST['orderplaced'])) {
  $tshirtid = $_POST['delete_id'];
  if ($_SESSION['orderplaced'] == "NO")
    $_SESSION['orderplaced'] = "YES";
  else
    $_SESSION['orderplaced'] = "NO";
  $orderplaced = $_SESSION['orderplaced'];
  $query = "update orders set orderplaced='$orderplaced' where tshirtid=$tshirtid";
  mysqli_query($conn, $query);
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: pending_custom_ordertable.php"));
  }
}
if (isset($_POST['viewsellershop'])) {
  $_SESSION['sid'] = $_POST['delete_id'];
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    $_SESSION['message'] = "Your Shop Order successfully";
    exit(header("Location: customershop.php"));
  }
}

if (isset($_POST['deletecustomershoporder'])) {
  $productid = $_POST['delete_id'];
  $customerid = $_SESSION['cid'];
  $query = "delete from customer_cart where productid='$productid' and customerid='$customerid'";
  // echo "hahaha you have been fooled";
  mysqli_query($conn, $query);
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    $_SESSION['message'] = "Your Shop Order successfully";
    exit(header("Location: customershoptable.php"));
  }
}
if (isset($_POST['deletesellerpendingorder'])) {
  $productid = $_POST['delete_id'];
  $customerid = $_POST['customerid'];
  $query = "delete from customer_cart where productid='$productid' and customerid='$customerid'";
  // echo "hahaha you have been fooled";
  mysqli_query($conn, $query);
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    $_SESSION['message'] = "Customer order deleted successfully";
    exit(header("Location: pending_order.php"));
  }
}

?>