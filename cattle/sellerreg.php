<?php
session_start();

?>
<?php
include("db_conection.php");
if(isset($_POST['register']))
{
$user_email = $_POST['ruser_email'];
$user_password = $_POST['ruser_password'];
$user_firstname = $_POST['ruser_firstname'];
$user_lastname = $_POST['ruser_lastname'];
$user_address = $_POST['ruser_address'];
$user_phone = $_POST['ruser_phone'];

$options = array("cost"=>4);
$hashPassword = password_hash($user_password,PASSWORD_BCRYPT,$options);



$check_user="select * from sellers WHERE user_email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_user);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Email is already registered, Please try another one!')</script>";
 echo"<script>window.open('index.php','_self')</script>";
exit();
    }
 
$saveaccount="insert into sellers (user_email,user_password,user_firstname,user_lastname,user_address,user_phone) VALUE ('$user_email','$hashPassword','$user_firstname','$user_lastname','$user_address','$user_phone')";
mysqli_query($dbcon,$saveaccount);
echo "<script>alert('successfully registered as a seller, You may now login!')</script>";				
echo "<script>window.open('index.php','_self')</script>";


				
	
			
		
	
		

}

?>
