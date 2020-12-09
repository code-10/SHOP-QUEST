<?php

      include_once '../header.php';
      include_once '../libraries/chocolates.php';
      session_start();

      $con=getCon();

      $user=$_SESSION['user_name'];
      $show=$_GET['show'];
      $unique_type_id=$_GET['unique_type_id'];
      $product_id=$_GET['product_id'];
      $product_name=$_GET['product_name'];
      $quantity=$_POST['quantity'];

      echo "i am in";

      if(isset($_SESSION['user_name']))
      {
            echo "i am logged in";
      if(isset($_POST['addtocart']))
      {
            echo "i am in cart";
            if(($con->query("insert into cart(user_name,unique_type_id,qty) values('$user','$unique_type_id','$quantity');"))===True)
            {
                header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&addtocart=yes&&show=".$show);
                die();
            }
            else
            {
                  header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&addtocart=yes&&show=".$show);
                  die();
            }
      }
      else if(isset($_POST['buy']))
      {
            echo "i am in buy";
            if(($con->query("insert into cart(user_name,unique_type_id,qty) values('$user','$unique_type_id','$quantity');"))===True)
            {
                 header("Location:cart.php?unique_type_id=".$unique_type_id."&&quantity=".$quantity);
                 die();
            }
            else
            {
                  header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&buy=no&&show=".$show);
                  die();
            }
            
      } 
      }
      else
      {
            $nolog=true;
            header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&nolog=".$nolog."&&show=".$show);
            die(); 
      } 
?>
      


<?php include_once '../footer.php'; ?>
