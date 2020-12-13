<?php 

    session_start(); 
	include_once '../libraries/chocolates.php';

	$con=getCon();

	$user=$_SESSION['user_name'];
    
    $unique_type_id=$_POST['unique_type_id'];
    $order_id_rate=$_POST['order_id_rate'];
    $rating=$_POST['rating']; 
    $review=$_POST['review'];

	
	echo $unique_type_id;echo "<br>";
	echo $order_id_rate;echo "<br>";
	echo $rating;echo "<br>";
	echo $review;echo "<br>";
	


    if(!(isset($_SESSION['user_name'])))
    {
        header("Location:../index.php");
        die(); 
    } 
     

    if(isset($_POST['submit_rating_and_review']))
    {
     	$con->query("update order_contents set o_rating='$rating',review='$review' where unique_type_id='$unique_type_id' and order_id='$order_id_rate'");   
	   
    }
    
  
  
      
  
  
  ?>
