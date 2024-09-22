<?php
require 'connection.php';
session_start();


if (isset($_POST['udelete-btn'])) {
  $id = $_POST['delete_id'];
  $users = $_SESSION['users'];
  $query = "delete from $users where id='$id'";
  $query1 = "delete from report where id='$id'";
  $query_run = mysqli_query($conn, $query);
  mysqli_query($conn, $query1);
  if ($users == "seller") {
    $query2 = "delete from products where sellerid='$id'";
    $query3 = "delete from customer_cart where sellerid='$id'";
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
  } else {
    $query3 = "SELECT * FROM orders WHERE id='$id'";
    $result = mysqli_query($conn, $query3);

    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $tshirtid = $row['tshirtid'];
        $tshirtid = mysqli_real_escape_string($conn, $tshirtid);

        $query4 = "DELETE FROM design2 WHERE id='$tshirtid'";
        mysqli_query($conn, $query4);
      }
    } else {
      echo "Error: " . mysqli_error($conn); // Add error handling
    }
    $query2 = "delete from orders where id='$id'";
    $query3 = "delete from customer_cart where customerid='$id'";
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
  }
  if ($query_run) {
    $_SESSION['message'] = "data deleted successfully";
  } else {
    $_SESSION['message'] = "data delete unsuccessful";
  }

  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: tableusers.php"));
  }
}


if (isset($_POST['seefile'])) {
  $id = $_POST['pendingsellerid'];
  $query = "select * from pendingseller where id=$id";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();
  $_SESSION['pdf file'] = $row['image_url'];
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: viewpdf.php"));
  }

}

if (isset($_POST['reject'])) {
  $id = $_POST['pendingsellerid'];
  $query = "delete from pendingseller where id=$id";
  mysqli_query($conn, $query);
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: pending_seller_request.php"));
  }

}

if (isset($_POST['approve'])) {
  $id = $_POST['pendingsellerid'];
  $query = "select * from pendingseller where id=$id";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();
  $name = $row['name'];
  $company_name = $row['company_name'];
  $email = $row['email'];
  $password = $row['password'];
  $address = $row['address'];
  $area = $row['area'];
  $phone = $row['phone'];
  $stmt = $conn->prepare("INSERT INTO sellers (name, company_name, email, password, address,area,phone) VALUES (?, ?, ?, ?, ?,?,?)");
  $stmt->bind_param("sssssss", $name, $company_name, $email, $password, $address, $area, $phone);



  $stmt->execute();
  $stmt->close(); // Close the statement but not the connection

  // Prepare and bind the delete statement
  $query2 = $conn->prepare("DELETE FROM pendingseller WHERE id = ?");
  $query2->bind_param("i", $id);

  // Set the id parameter and execute
  $query2->execute();
  $query2->close(); // Close the statement


  $conn->close();
  $_SESSION['message'] = "Seller has been added succesfully";
  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: pending_seller_request.php"));
  }

}

if (isset($_POST['viewshopseller'])) {
  $sellerid = $_POST['delete_id'];
  $_SESSION['sid'] = $sellerid;

  if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
  } else {
    exit(header("Location: customershop.php"));
  }

}


?>