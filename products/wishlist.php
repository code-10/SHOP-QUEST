<?php
  
  session_start();
  include '../libraries/chocolates.php';
  $con = getCon();  

  $show=$_GET['show']; 
  $wishdo=$_GET['wishdo'];
  $product_id=$_GET['product_id'];
  $user=$_SESSION['user_name'];
  $product_name=$_GET['product_name'];
  $user=strtolower($user);
  

  
  if(isset($_SESSION['user_name']))
  {
    if($wishdo=="yes"){
      if(($con->query("insert into wishlist(user_name,product_id) values('$user','$product_id');"))===True)
      {
        header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&show=".$show."&&wish=yes");
        die();
      }
     }
    
    
    else if($wishdo=="no")
    {
         $sql="delete from wishlist where user_name='$user' and product_id='$product_id'" ;
   
           if($con->query($sql)===True)
           {    
                  header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&show=".$show."wish=no");
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
