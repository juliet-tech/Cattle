<?php
session_start();

if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

?>

<?php
 include("config.php");
 extract($_SESSION); 
          $stmt_edit = $DB_con->prepare('SELECT * FROM sellers WHERE user_email =:user_email');
        $stmt_edit->execute(array(':user_email'=>$user_email));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
        
        ?>

<?php
include("db_conection.php");
if(isset($_POST['item_save']))
{
$user_id = $_POST['user_id'];
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$item_weight = $_POST['item_weight'];
$item_old = $_POST['item_old'];
$item_desc = $_POST['item_desc'];

 
 $check_item="select * from items WHERE item_name='$item_name'";
    $run_query=mysqli_query($dbcon,$check_item);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Item is already registered, Please try another one!')</script>";
 echo"<script>window.open('index.php','_self')</script>";
exit();
    }
 
$imgFile = $_FILES['item_image']['name'];
$tmp_dir = $_FILES['item_image']['tmp_name'];
$imgSize = $_FILES['item_image']['size'];

$upload_dir = 'item_images/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;


				
	
			if(in_array($imgExt, $valid_extensions)){			
		
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
					$saveitem="insert into items (user_id,item_name,item_price,item_weight,item_old,item_desc,item_image,item_date) VALUE ('$user_id','$item_name','$item_price','$item_weight','$item_old','$item_desc','$itempic',CURDATE())";
					mysqli_query($dbcon,$saveitem);
					 echo "<script>alert('Cattle successfully saved!')</script>";				
					 echo "<script>window.open('items.php','_self')</script>";
				}
				else{
					
					 echo "<script>alert('Sorry, your file is too large.')</script>";				
					 echo "<script>window.open('items.php','_self')</script>";
				}
			}
			else{
				
				 echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";				
					 echo "<script>window.open('items.php','_self')</script>";
				
			}
		
	
		

}

?>









