<?php 

	include '../header.php'; 
	include_once '../libraries/chocolates.php'; 
	session_start(); 

	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit; 

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
            <a href="#" class="nav-item nav-link">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
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
   
   
   <!--search bar-->
					<div id="search" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="search.php" class="form-inline input-group d-flex justify-content-center" style="padding:0.60rem!important">
      							<div class="input-group">
  								<input type="text" class="form-control" name="search_product" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
  								<div class="input-group-append">
    									<button class="btn btn-outline-light" type="submit">Search</button>
  								</div>
							</div>
    						</form>
						</div>
					</div>
          
          
          <?php
          $con = getCon();
  
     $search_prod = mysqli_real_escape_string($con,$_GET['search_product']);
      
     $sql="select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where product_name like '%$search_prod%' or product_brand like '%$search_prod%' or product_description like '%$search_prod%' group by products.product_id";
     //$res = $con->query("select * from products where product_name like '%$search_prod%' or product_brand like '%$search_prod%' or product_description like '%$search_prod%'");
    $res=$con->query($sql);
    
    $product_id=array();
    $product_name=array();
    $product_price=array();
    $product_rating=array();
    
    while($p = $res->fetch_assoc())
    {
        $product_id[]=$p['product_id'];
        $product_name[]=$p['product_name'];
        $product_price[]=$p['price'];
        $product_rating[]=$p['rating'];
    }
    
    $n=count($product_id);
    
   ?>
    
   
	
	
	<h5 class="mb-4 mt-4 mr-2 ml-2 text-center">Search Results</h5>
	
    <?$c=1; $lim=$n/4+1; for($j=1;$j<=$lim;$j++){ ?>
    <div class="container">
  <div class="row p-2">
    <? for($i=1;$i<=4;$i++){ ?> 
    <? if(4*($j-1)+$i>$n) break; ?>
   <div class="col-sm-6 col-lg-3 col-6 text-center">
      <figure class="figure">
        <a href='../products/product_description.php?product_id=<?=$product_id[$c-1]?>&&product_name=<?=$product_name[$c-1]?>&&show=0'>
          <img src="..." class="figure-img img-fluid rounded mx-auto d-block" alt="product" onerror="this.src='../assets/black.png';">
        </a>
        <figcaption class="text-center">
            <h5><?=$product_name[$c-1]?></h5>
          <h5>Rating : <?=$product_rating[$c-1]?>&nbsp;&nbsp;</h5>
           <h5>Price : <?=$product_price[$c-1]?>&nbsp;&nbsp;</h5> 
           </figcaption>
      </figure>
    </div>
  <? $c++;} ?>
      </div> 
     </div>
    <? } ?> 	
      
    
   
   
   
</body>
  
  
  <?php include '../footer.php'; ?>
