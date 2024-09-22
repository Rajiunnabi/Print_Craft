<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PDF Document</title>
    <style>
        .container{padding : 30px;}
    </style>
    </head>
    <body>
        <div class="container">
            <embed src=<?php echo $_SESSION['pdf file'];?> type="application/pdf" width=100% height="600px"/>
        </div>  
    </body>
</html>