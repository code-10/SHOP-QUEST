<?php 

    session_start(); 
	  include_once '../libraries/chocolates.php';

	  $con=getCon();

	  $user=$_SESSION['user_name'];
    
    if(isset($_POST['submit_return_or_replace']))
    {
        $reason=$_POST['reason'];
	$unique_type_id_rar=$_POST['unique_type_id_rar'];
	$order_id_rar=$_POST['order_id_rar'];
	$quantity_rar=$_POST['quantity_rar'];
	    
	/*echo $reason; echo "<br>";
	echo $unique_type_id_rar; echo "<br>";
	echo $order_id_rar; echo "<br>";
	echo $quantity_rar; echo "<br>";*/
	    
	$con->query("insert into process_return_or_replace(user_name,order_id,unique_type_id,quantity,reason,status) values('".mysqli_real_escape_string($con,$user)."','".mysqli_real_escape_string($con,$order_id_rar)."','".mysqli_real_escape_string($con,$unique_type_id_rar)."','".mysqli_real_escape_string($con,$quantity_rar)."','".mysqli_real_escape_string($con,$reason)."',1)");	    
	    
	header("Location:user_orders.php?order_details=yes&&request_sent=yes&&order_id_detail=".$order_id_rar);
	
	    
    }
  
?>
