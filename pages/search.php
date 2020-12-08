<?php include '../header.php'; ?>

<body>
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">ShopShop</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="#" class="nav-item nav-link active">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
               echo '<a href="product/cart_display.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart"></i></a>';
               echo '<a href="../login/logout.php" class="nav-item nav-link">Logout</a>';
               }
               else{
               echo '<a href="../register/register.php" class="nav-item nav-link">Register</a>
                       <a href="../login/login.php" class="nav-item nav-link">Login</a>';
               }
               ?>
         </div>
      </div>
   </nav>
   
   
   <!--search bar-->
					<div id="search" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="search.php" class="form-inline input-group" style="padding:0.60rem!important">
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
     
     $res = $con->query("select * from products where product_name like '%$search_prod%' or product_brand like '%$search_prod%' or product_description like '%$search_prod%'");
    
    
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
    
   
	
	
	
    <?$c=1; $lim=$n/4+1; for($j=1;$j<=$lim;$j++){ ?>
    <div class="container">
  <div class="row p-2">
    <? for($i=1;$i<=4;$i++){ ?> 
    <? if(4*($j-1)+$i>$n) break; ?>
   <div class="col-sm-6 col-lg-3 text-center">
      <figure class="figure">
        <a href='products/product_description.php?product_id=<?=$product_id[$c-1]?>&&product_name=<?=$product_name[$c-1]?>&&show=0'>
          <img src="..." class="figure-img img-fluid rounded mx-auto d-block" alt="product" onerror="this.src='assets/black.png';">
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
