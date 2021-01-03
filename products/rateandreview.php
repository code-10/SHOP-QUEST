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
	    
	$rar=$con->query("select p.rating_no,p.product_id,p.rating_sum from products as p,unique_product as up where up.product_id=p.product_id and up.unique_type_id='$unique_type_id'");
	
	$rno=Array();
	$rsum=Array();
	$product_id_rar=Array();
	    
	while($rard=$rar->fetch_assoc())
	{
		$rno[]=$rard['rating_no'];
		$rsum[]=$rard['rating_sum'];
		$product_id_rar[]=$rard['product_id'];
	}
	 
	$rno=$rno[0]+1;
	$rsum=$rsum[0]+$rating;
	$final_rating=$rsum/$rno;
	    
	$con->query("update products set rating_no='$rno',rating_sum='$rsum',rating='$final_rating' where product_id='$product_id_rar[0]'");
	    
	header("Location:user_orders.php?order_details=yes&&order_id_detail=".$order_id_rate);
        die();    
	   
	    
    }
    
  
  
      
  
  
  ?>
