<?php include_once '../header.php'; ?>

<?php

    session_start();
    include '../libraries/chocolates.php';
    

	$con=getCon();
 
?>




<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">ShopQuest</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="../pages/about.php" class="nav-item nav-link">About</a>
        </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])) {
                    echo '<a href="../pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
                    echo '<a href="../products/cart.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart"></i></a>';
                    echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
                }
                else{
                    echo '<a href="../sign_in/sign_in.php" class="nav-item nav-link">Sign in</a>';
                }
            ?>
        </div>
    </div>
</nav>
  
 
  
 
 <?php
  $user=$_SESSION['user_name'];
    $con = getCon();
  echo $user;  
      $res = $con->query("select products.product_id,product_name from products inner join unique_product on products.product_id=unique_product.product_id where unique_product.seller_user_name='$user'");
  
    $product_id=Array();
    $product_name=Array();
    
    while($ele = $res->fetch_assoc())
    {
        $product_id[]=$ele['product_id'];
        $product_name[]=$ele['product_name'];
    }
   
    $n=count($product_id);
    
  ?>   
    
    
    
    
  <!--code from index.php card decks logic added-->
   <p class="display-4 text-center"><?=$cat_name;?></p>
    <br>
    <?$c=1; $lim=$n/4+1; for($j=1;$j<=$lim;$j++){ ?>
    <div class="container">
  <div class="row p-2">
    <? for($i=1;$i<=4;$i++){ ?> 
    <? if(4*($j-1)+$i>$n) break; ?>
   <div class="col-sm-6 col-lg-3 col-6 text-center">
      <figure class="figure">
        <a href='../products/product_description.php?product_id=<?=$product_id[$c-1]?>&&product_name=<?=$product_name[$c-1]?>&&show=0'>
          <img src="../assets/<?=$product_id[$c-1]?>.jpeg" class="figure-img img-fluid rounded mx-auto d-block" alt="product" onerror="this.src='../assets/black.png';">
        </a>
        <figcaption class="text-center">
	<?php if($bestsell[0]==$product_id[$c-1]) { ?>
	   	<span class="badge badge-success">Best Seller</span>
	   <?php } ?>
            <h5><?=$product_name[$c-1]?></h5>
          <!-- <h5>Rating : <?=$product_rating[$c-1]?> (<?=$product_rating_no[$c-1]?>)</h5>
           <h5>Price : <?=$product_price[$c-1]?>&nbsp;&nbsp;</h5> -->
           </figcaption>
      </figure>
    </div>
  <? $c++;} ?>
      </div> 
     </div>
    <? } ?>  
    
    
    
    
    
    
    
    
    

</body>

<style media="screen">
            .figure {display: table;margin-right: auto;margin-left: auto;}
            .figure-caption {display: table-caption;caption-side: bottom;text-align: center;}
</style>    
  

<?php include_once '../footer.php'; ?>

