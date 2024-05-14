<?php
session_start();

?>

<?php 
require_once("db_conection.php");
if(isset($_POST['user_login'])){
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    
    $sql = "select * from users where user_email = '".$user_email."'";
    $rs = mysqli_query($dbcon,$sql);
    $numRows = mysqli_num_rows($rs);
    
    if($numRows  == 1){
        $row = mysqli_fetch_assoc($rs);
        if(password_verify($user_password,$row['user_password'])){
            echo "<script>alert('You're successfully login!')</script>";
       
            echo "<script>window.open('Buyers/index.php','_self')</script>";

            $_SESSION['user_email']=$user_email;
        }
        else{
            echo "<script>alert('Email or password is incorrect!')</script>";
          echo "<script>window.open('index.php','_self')</script>";
        }
    }
    else{
        echo "No User found";
    }
}