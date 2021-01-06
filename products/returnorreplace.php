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
	    
	echo $reason; echo "<br>";
	echo $unique_type_id_rar; echo "<br>";
	echo $order_id_rar; echo "<br>";
	echo $quantity_rar; echo "<br>";
    
    }
  
?>
