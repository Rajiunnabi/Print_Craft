<?php
  include 'connection.php';
  session_start();
  if(isset($_POST['signup'])){
     $name=$_POST['username'];
     $email =$_POST['email'];
     $password=$_POST['password'];
     $checkname="select * from users where name='$name'";
     $result=$conn->query($checkname);
     if($result->num_rows>0){
        $_SESSION['message']="name already exist";
        if (headers_sent()) {
            die("Redirect failed. Please click on this link: <a href=...>");
        }
        else{
            exit(header("Location: login.php"));
        }
     }else{
        try{
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
            $stmt->execute();
            if (headers_sent()) {
                die("Redirect failed. Please click on this link: <a href=...>");
            }
            else{
                exit(header("Location: login.php"));
            }
        }catch(mysqli_sql_exception){
            echo "Error";
        }
       
     }
 }
 if(isset($_POST['login'])){
    $name=$_POST['username'];
    $password=$_POST['password'];
    if(isset($_POST['checkbox'])){
        $sql="select * from sellers where name='$name'";
    }else{
         $sql="select * from users where name='$name'";
    }
    
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        if($password!=$row['password']){
           $_SESSION['message']="Password didnot match";
           if (headers_sent()) {
            die("Redirect failed. Please click on this link: <a href=...>");
        }
        else{
            exit(header("Location: login.php"));
        }
        }else{
            if(isset($_POST['checkbox'])){
               session_start();
                $_SESSION['sid']=$row['id'];
                $_SESSION['sname']=$row['name'];
                $_SESSION['scompany_name']=$row['company_name'];
                $_SESSION['semail']=$row['email'];
                $_SESSION['sphone']=$row['phone'];
                $_SESSION['spassword']=$row['password'];
                $_SESSION['saddress']=$row['address'];
                $_SESSION['sarea']=$row['area'];
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=...>");
                }
                else{
                    exit(header("Location: Seller-home.php"));
                }
            }else{
                session_start();
                $_SESSION['cid']=$row['id'];
                $_SESSION['cname']=$row['name'];
                $_SESSION['cemail']=$row['email'];
                $_SESSION['cphone']=$row['phone'];
                $_SESSION['cpassword']=$row['password'];
                $_SESSION['caddress']=$row['address'];
                $_SESSION['carea']=$row['area'];
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=...>");
                }
                else{
                    exit(header("Location: customer.php"));
                }
            }
           
    }
    }else{
       $_SESSION['message']="Not found Incorrect user";
       if (headers_sent()) {
        die("Redirect failed. Please click on this link: <a href=...>");
    }
    else{
        exit(header("Location: login.php"));
    }
    }
  
 }

?>

