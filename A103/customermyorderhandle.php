<?php
if(isset($_POST['customdesign'])){
    header("location: my_order.php");
}
if(isset($_POST['ordersfromshop'])){
    header("location: customershoptable.php");
}
?>