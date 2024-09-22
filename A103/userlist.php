<?php
  require 'connection.php';
  session_start();
  if(isset($_POST['customerlist'])){
    $_SESSION['users']="users";
  }
  if(isset($_POST['sellerlist'])){
    $_SESSION['users']="sellers";
  }
if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href=...>");
}
else{
    exit(header("Location: tableusers.php"));
}



?>