<?php

      include_once '../header.php';
      include_once '../libraries/chocolates.php';
      session_start();
      
      $user=$_SESSION['user_name'];
      $show=$_GET['show'];
      $unique_type_id=$_GET['unique_type_id'];
      $product_id=$_GET['product_id'];
      $product_name=$_GET['product_name'];

      if(!(isset($_SESSION['user_name'])))
      {
            $nolog=true;
            header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&nolog=".$nolog."&&show=".$show);
            die(); 
      }
      
?>


<?php include_once '../footer.php'; ?>
