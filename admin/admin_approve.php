<?php
  
  session_start();
  include '../libraries/chocolates.php';
  $con=getCon();

  
      $subcategoryid=$_POST['subcatid'];
      $productid=$_POST['product_id'];
      $productname=$_POST['product_name'];
      $productbrand=$_POST['product_brand'];
      $productdescription=$_POST['product_description'];
      $price=$_POST['price'];
      $quantity=$_POST['qty'];
      $color=$_POST['color'];
      $size=$_POST['size'];
      $sellername=$_POST['seller_name'];
      $rating=$_POST['rating'];          

     
  
      //For Store info
      $approved=$_POST['approve'];
      $storeinfoid=$_POST['storeinfoid'];
      $done=1;      

      //for updating store info
      $sql1="update store_info set approved='$done' where store_info_id='$storeinfoid'";
      $sql2="insert into products(product_id,product_name,sub_cat_id,product_brand,product_description,rating) values('".mysqli_real_escape_string($con,$productid)."','".mysqli_real_escape_string($con,$productname)."','".mysqli_real_escape_string($con,$subcategoryid)."','".mysqli_real_escape_string($con,$productbrand)."','".mysqli_real_escape_string($con,$productdescription)."','".mysqli_real_escape_string($con,$rating)."')";
      $sql3="insert into unique_product(product_id,price,quantity,seller_user_name,color,size) values('".mysqli_real_escape_string($con,$productid)."','".mysqli_real_escape_string($con,$price)."','".mysqli_real_escape_string($con,$quantity)."','".mysqli_real_escape_string($con,$sellername)."','".mysqli_real_escape_string($con,$color)."','".mysqli_real_escape_string($con,$size)."')";
      
      if($con->query($sql2)===True)
      {
        if($con->query($sql3)===True)
        {
          if($con->query($sql1)===True)
          {
              header("Location:sell_request.php");
                die();
          }
        }
      }
      else
      {
        echo "something went wrong"; 
      }

?>
