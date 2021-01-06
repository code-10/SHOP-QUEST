<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	} 


		$con=getCon();
    
    $res1=$con->query("update store_info set quantity='$quantity', approved=0 where store_info_id='$store_info_id'");
    
    
    header("Location:seller_enter.php?my_sell_requests=yes&&aprstatus=0");
    
?>
