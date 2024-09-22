<?php
 require 'connection.php';
 session_start();
 if(isset($_POST['creportsubmit'])){
     $id=$_SESSION['cid'];
     $title=$_POST['creporttopic'];
     $description=$_POST['creportdescription'];
     $query="insert into report (id,seller,title,description) values ('$id',0,'$title','$description')";
     mysqli_query($conn,$query);
     if (headers_sent()) {
        die("Redirect failed. Please click on this link: <a href=...>");
    }
    else{
        exit(header("Location: customer.php"));
    }
 }

 if(isset($_POST['sreportsubmit'])){
    $id=$_SESSION['sid'];
    $title=$_POST['sreporttopic'];
    $description=$_POST['sreportdescription'];
    $query="insert into report (id,seller,title,description) values ('$id',1,'$title','$description')";
    mysqli_query($conn,$query);
    if (headers_sent()) {
       die("Redirect failed. Please click on this link: <a href=...>");
   }
   else{
       exit(header("Location: Seller-home.php"));
   }
}



?>

