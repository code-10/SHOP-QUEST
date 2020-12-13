<?php 

    session_start(); 
	include_once '../libraries/chocolates.php';

	$con=getCon();

	$user=$_SESSION['user_name'];
    
	echo "in";

    $unique_type_id=$_POST['unique_type_id'];
    $order_id_rate=$_POST['order_id_rate'];
    
    if(!(isset($_SESSION['user_name'])))
    {
        header("Location:../index.php");
        die(); 
    } 
    
	echo $order_id_rate;
        echo "<br>";
        echo $unique_type_id;    

    if(isset($_POST['submit_rating']))
    {
        
    }
    
  
  
      
  
  
  ?>
