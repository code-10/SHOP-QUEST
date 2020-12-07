<?php

session_start();
$sub_cat_id=$_SESSION['sub_cat_id_show'];
$sub_cat_name=$_SESSION['sub_cat_name_show'];
    
$id_s = intval($_GET['q']);

include_once '../libraries/chocolates.php';
$con = getCon();
    if($id_s==1)
      $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id");
    else if($id_s==2)
        $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id order by price");
    else if($id_s==3)
      $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id order by price desc");
    else
      $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id order by rating desc");
  
    
    
    $product_id=Array();
    $product_name=Array();
    $product_price=Array();
    $product_rating=Array();
    
    while($ele = $res->fetch_assoc())
    {
        $product_id[]=$ele['product_id'];
        $product_name[]=$ele['product_name'];
        $product_price[]=$ele['price'];
        $product_rating[]=$ele['rating'];
    }
   
    $n=count($product_id);
    $c=1;
$lim=$n/4+1; 
    
    echo '
        <p class="display-4 text-center"><?=$cat_name;?></p>
    <br>
    ';

    for($j=1;$j<=$lim;$j++){
    echo '<div class="container">
  <div class="row p-2">';
   for($i=1;$i<=4;$i++) { 
    if(4*($j-1)+$i>$n) break; 
   echo '<div class="col-sm-6 col-lg-3 text-center">
      <figure class="figure">
        <a href="../products/product_description.php?product_id='.$product_id[$c-1].'&&product_name='.$product_name[$c-1].'">
          <img src="..." class="figure-img img-fluid rounded mx-auto d-block" alt="product" onerror="this.src=\'../assets/black.png\';">
        </a>
        <figcaption class="text-center">
            <h5>'.$product_name[$c-1].'</h5>
          <h5>Rating : '.$product_rating[$c-1].'&nbsp;&nbsp;</h5>
           <h5>Price : '.$product_price[$c-1].'&nbsp;&nbsp;</h5> 
           </figcaption>
      </figure>
    </div>';
       $c++;}
        
       echo '
      </div> 
     </div>';
    }


?>
