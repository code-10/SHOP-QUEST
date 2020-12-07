<?php include_once '../header.php'; ?>

<?php

    session_start();
    include_once '../libraries/chocolates.php';
    
    $product_id=$_GET['product_id'];
    $product_name=$_GET['product_name'];
    $itsprice=$_GET['price'];
  
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
            <a href="../pages/about.php" class="nav-item nav-link">About</a>
        </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])) {
                    echo '<a href="../pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
                    echo '<a href="cart_display.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart"></i></a>';
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
						<form method="GET" action="search.php" class="form-inline input-group p-4">
      							<div class="input-group">
  								<input type="text" class="form-control" name="search_product" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
  								<div class="input-group-append">
    									<button class="btn btn-outline-light" type="submit">Search</button>
  								</div>
							</div>
    						</form>
						</div>
					</div>
  
  <br><br>
	
  <?php
  
  
    
    $con = getCon();
    $res= $con->query("select * from products where product_id='$product_id'");
  
    $product_description=Array();
    $product_price=Array();
    $product_rating=array();
    $product_brand=Array();
        
    while($ele = $res->fetch_assoc())
    {
        $product_description=$ele['product_description'];
        $product_price=$ele['price'];
        $product_rating=$ele['rating'];
        $product_brand=$ele['product_brand'];
    }
    
    	$n=count($product_description);
	
	if($product_rating_star == round($product_rating))
	{
		$whole=True;
	}
	else
	{
		$product_rating_star=round($product_rating);
		$whole=False;
	}
	
	
	
	
	
	
	
    
     $wstate=$_GET['wstate'];
     $astate=$_GET['astate'];                                         
     $nolog=$_GET['nolog'];
     $nostock=$_GET['nostock'];
     $cartd=$_GET['cartd'];
     $carta=$_GET['carta'];
  
  ?>
  
  
  
<div class="container">
  <div class="text-center">
    <? if($nolog)
          echo "<h4>You are not logged in</h4>";
      else if($wstate)
          echo "<h4>Wishlisted</h4>";
      else if($astate)
          echo "<h4>Already Wishlisted</h4>";
      else if($nostock)
          echo "<h4>Out of Stock</h4>";
      else if($cartd)
          echo "<h4>added to cart</h4>";
      else if($carta)
          echo "<h4>Already in cart</h4>";
    ?>
  </div>
</div>
  
  
    
    
    <div class="text-center m-4">
	
	
		<div class="row">
			<div class="col-lg-6 col-xs-2 col-sm-2 col-md-2">
				<img src="..." class="img-fluid" alt="product" onerror="this.src='../assets/black.png';">
			</div>
			
			<div class="col-lg-6 col-xs-2 col-sm-2 col-md-2">
				
                	<div class="card-body p-1 m-1">
                    <h5 class="card-title text-center"><?=$product_name;?></h5><br>
                    <p class="card-text ml-4 mr-4">Rating : <?=$product_rating;?></p>
                    <p class="card-text ml-4 mr-4">Brand : <?=$product_brand;?></p>
                    
                    <div class="text-center"><br>
                        <a href='wishlist.php?product_id=<?=$product_id?>&&product_name=<?=$product_name?>' class="btn btn-dark mb-4 text-center" role="button">Wishlist</a>
                    </div>		
				
				
                    <!--variants-->
		    <a href="#here"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    			PURCHASE
		    </button></a>
				
		    <div id="here"></div>
				
		    <div class="collapse ml-2 mr-2 mt-4 mb-4" id="collapseExample">
  			<div id="here" class="card card-body">
				<div class="row">
					<? for($i=1;$i<=4;$i++){ ?> 
    					<? if(4*($j-1)+$i>$n) break; ?>
						<div class="col-md-6 col-lg col-xl">
							
							<figure class="figure">
        							<a href='../product/product_description.php?product_id=<?=$prod_id[$c-1]?>&&product_name=<?=$prod_name[$c-1]?>'>
          								<img src="..." class="figure-img img-fluid rounded mx-auto d-block" style="width:60%;height:50%;" alt="product" onerror="this.src='../assets/black.png';">
        							</a>
        							<figcaption class="figure-caption text-center">
									<p></p>
									<h5><a href="#" class="badge badge-success">BUY</a></h5>
         							</figcaption>
      							</figure>	
							
						</div>
   					<? } ?>
				</div>
  			</div>
		    </div>
		    <!--variants-->		
                    
                    <div class="row m-4">
                        <p class="p-4">Description : <?=$product_description;?></p>
                    </div>
                    
                 </div>
                
				
			</div>
		</div>
	</div>
    
    
    
    
  </body>




<style media="screen">
            .figure {display: table;margin-right: auto;margin-left: auto;}
            .figure-caption {display: table-caption;caption-side: bottom;text-align: center;}
</style>


<?php include_once '../footer.php'; ?>
