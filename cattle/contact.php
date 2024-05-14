<?php
session_start();

?>
<?php
include("db_conection.php");
if(isset($_POST['contact']))
{
$user_fullname = $_POST['ruser_fullname'];
$user_phone    = $_POST['ruser_phone'];
$user_message = $_POST['ruser_message'];



$check_user="select * from contact WHERE user_phone='$user_phone'";
    $run_query=mysqli_query($dbcon,$check_user);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('You have already contacted us, you may also give us a call on 0712345678, thank you!')</script>";
 echo"<script>window.open('index.php','_self')</script>";
exit();
    }
 
$saveaccount="insert into contact (user_fullname,user_phone,user_message) VALUE ('$user_fullname','$user_phone','$user_message')";
mysqli_query($dbcon,$saveaccount);
echo "<script>alert('Your message was successfully send, one of our agents will reach out to you within 24hrs, thank you!')</script>";				
echo "<script>window.open('index.php','_self')</script>";


				
	
			
		
	
		

}

?>
