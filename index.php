<?php include_once 'header.php'; ?>
<?php include_once 'libraries/chocolates.php' ?>
<?php 
	
	session_start(); 
	
	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;


	$con=getCon();

	
	

?>

	<body>
		<style media="screen">
		.figure {
			display: table;
			margin-right: auto;
			margin-left: auto;
		}
		
		.figure-caption {
			display: table-caption;
			caption-side: bottom;
			text-align: center;
		}
		
		.card {
			border: none;
		}
		</style>
		
		<!--Navigation Bar-->
		<nav class="navbar navbar-expand-md navbar-dark bg-dark"> <a href="#" class="navbar-brand">ShopQuest</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"> <span class="navbar-toggler-icon"></span> </button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<div class="navbar-nav">
					<a href="#" class="nav-item nav-link active">Home</a>
					<a href="pages/about.php" class="nav-item nav-link">About</a>
				</div>
				
				<div class="navbar-nav ml-auto">
					<?php if(isset($_SESSION['user_name'])) {
                    				echo '<a href="pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
                    				echo '<a href="products/cart.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart" style="font-size:20px"></i></a>';
                    				echo '<a href="sign_in/logout.php" class="nav-item nav-link">Logout</a>';
                			}
                			else{
                    				echo '<a href="sign_in/sign_in.php" class="nav-item nav-link">Sign in</a>';
                			}?> 
				</div>
			</div>
		</nav>
		
		
		<!--search bar-->
					<div id="search" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="pages/search.php" class="form-inline input-group  d-flex justify-content-center" style="padding:0.60rem!important">
      							<div class="input-group">
  								<input type="text" class="form-control" name="search_product" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
  								<div class="input-group-append">
    									<button class="btn btn-outline-light" type="submit">Search</button>
  								</div>
							</div>
    						</form>
						</div>
					</div>
		
		
		<!--main card carousel-->
		<!--<div id="main-card" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active" data-interval="10000"> <img src="assets/caro1.jpg" class="img-fluid" alt="..." style="width:100%;"> </div>
				<div class="carousel-item" data-interval="2000"> <img src="assets/caro2.jpg" class="img-fluid" alt="..." style="width:100%;"> </div>
				<div class="carousel-item"> <img src="assets/caro3.jpg" class="img-fluid" alt="..." style="width:100%;"> </div>
			</div>
			<a class="carousel-control-prev" href="#main-card" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
			<a class="carousel-control-next" href="#main-card" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
		</div>-->
          
          
          
		   <?php
  
                	$con = getCon();
                	$categories=Array();
                	$res = $con->query("select * from categories");
                	
			while($ele = $res->fetch_assoc()){
                    		$categories[]=$ele['cat_name'];
                	}
  
            	   ?>
        
		<!--github repo-->
		<div class="alert alert-dark text-center" role="alert" style="padding:0.2rem"><a href="https://github.com/code-10/SHOP-QUEST" style="color:black;"><i class="fa fa-github mr-2"></i>Github Repository</a></div>
		
		
		<!--just space-->
        	<div class="mt-2 mb-2 text-center">
		</div>
		
		
		<!--Loop category-->
		<div id="category">
		<h5 class="text-center">Categories</h5>
		
        
			
		<div class="row m-4 d-flex justify-content-center">
			<?php $c=1; for($i=0;$i<8;$i++) { ?>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-3">
					<div class="card text-center">
						<a href='sub_categories/sub_category.php?cat_id=<?=$c;?>&&cat_name=<?=$categories[$c-1];?>' class="stretched-link">
  						<img class="card-img-top" src="assets/categories/cat<?=$i+1?>.png" alt="Category" onerror="this.src='assets/black.png';">
  							<div class="text-center">
    								<p class="card-title mob" style="color:black;"><?=$categories[$i];?></p>
  							</div>
						</a>
					</div>
				</div>
			<?php $c++; } ?>
		</div>
			
			
		
			
			
		<?php if(isset($_SESSION['user_name'])) { 
			
			$user=$_SESSION['user_name'];
			
			$user_viewed=$con->query("select p.product_name,p.product_id,u.number_of_times_viewed from products as p,user_viewed as u where p.product_id=u.product_id and user_name='$user' order by u.number_of_times_viewed desc limit 4");
			$uv_product_id=Array();
			$uv_product_name=Array();
			while($uv=$user_viewed->fetch_assoc())
			{
				$uv_product_id[]=$uv['product_id'];
				$uv_product_name[]=$uv['product_name'];
			}
	
			$countofuv=count($uv_product_id);
			$uvc=min($countofuv,4);
			
			if($uvc>0) { 
		?>
        
			
			
		<div id="user_viewed">
		<h5 class="text-center">Products related to your search</h5>
			
		<div class="row m-4 d-flex justify-content-center">
			<?php for($k=0;$k<$uvc;$k++) { ?>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-3">
					<div class="card text-center">
						<a href="products/product_description.php?product_id=<?=$uv_product_id[$k]?>&&product_name=<?=$uv_product_name[$k]?>&&show=0" class="stretched-link">
  						<img class="card-img-top" src="..." alt="Category" onerror="this.src='assets/black.png';">
  							<div class="text-center">
    								<p class="card-title mob" style="color:black;"><?=$uv_product_name[$k];?></p>
  							</div>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
				
		
			
		<?php } else { ?>
			
			<h5 class="text-center">Shop from ShopQuest</h5>
			
		<?php } } ?>
			
			
			
			
			
			
			
			
			
		<!--most viewed-->
		<div id="most_viewed">
		<h5 class="text-center">Most viewed</h5>
		
		<?php
			
			$most_viewed=$con->query("select p.product_name,p.product_id,m.number_of_times_viewed from products as p,most_viewed as m where p.product_id=m.product_id order by m.number_of_times_viewed desc limit 4");
			$mw_product_id=Array();
			$mw_product_name=Array();
			while($mw=$most_viewed->fetch_assoc())
			{
				$mw_product_id[]=$mw['product_id'];
				$mw_product_name[]=$mw['product_name'];
			}
			
			$mwc=min(count($mw_product_id),4);
			
		?>
        
			
		<div class="row m-4 d-flex justify-content-center">
			<?php $c=1; for($i=0;$i<$mwc;$i++) { ?>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-3">
					<div class="card text-center">
						<a href="products/product_description.php?product_id=<?=$mw_product_id[$i]?>&&product_name=<?=$mw_product_name[$i]?>&&show=0" class="stretched-link">
  						<img class="card-img-top" src="..." alt="Category" onerror="this.src='assets/black.png';">
  							<div class="text-center">
    								<p class="card-title mob" style="color:black;"><?=$mw_product_name[$i];?></p>
  							</div>
						</a>
					</div>
				</div>
			<?php $c++; } ?>
		</div>
			
		
	</body>
		
		
<style>
    /*Media Queries*/
	@media (min-width:320px)  { .mob{font-size:8px;} /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .mob{font-size:16px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .mob{font-size:16px;} /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .mob{font-size:16px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .mob{font-size:16px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .mob{font-size:16px;}  /* hi-res laptops and desktops */ }
	
</style>		


<?php include_once 'footer.php'; ?>
