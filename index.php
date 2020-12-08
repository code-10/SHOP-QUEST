<?php include_once 'header.php'; ?>
<?php include_once 'libraries/chocolates.php' ?>
<?php 
	
	session_start(); 
	
	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

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
                    				echo '<a href="product/cart_display.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart style="font-size:36px""></i></a>';
                    				echo '<a href="login/logout.php" class="nav-item nav-link">Logout</a>';
                			}
                			else{
                    				echo '<a href="register/register.php" class="nav-item nav-link">Register</a>
                            			<a href="login/login.php" class="nav-item nav-link">Login</a>';
                			}?> 
				</div>
			</div>
		</nav>
		
		
		<!--search bar-->
					<div id="search" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="pages/search.php" class="form-inline input-group" style="padding:0.60rem!important">
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
		<div id="main-card" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active" data-interval="10000"> <img src="assets/caro1.jpg" class="img-fluid" alt="..." style="width:100%;"> </div>
				<div class="carousel-item" data-interval="2000"> <img src="assets/caro2.jpg" class="img-fluid" alt="..." style="width:100%;"> </div>
				<div class="carousel-item"> <img src="assets/caro3.jpg" class="img-fluid" alt="..." style="width:100%;"> </div>
			</div>
			<a class="carousel-control-prev" href="#main-card" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
			<a class="carousel-control-next" href="#main-card" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
		</div>
          
          
          
		   <?php
  
                	$con = getCon();
                	$categories=Array();
                	$res = $con->query("select * from categories");
                	
			while($ele = $res->fetch_assoc()){
                    		$categories[]=$ele['cat_name'];
                	}
  
            	   ?>
        
		<!--just space-->
        	<div class="mt-2 mb-2 text-center">
		</div>
		
		<!--<a href='sub_categories/sub_category.php?cat_id=<?=$c;?>&&cat_name=<?=$categories[$c-1];?>' class="stretched-link"><h5><?=$categories[$c-1];?></h5></a>-->
		
		<!--Loop category-->
		<div id="category">
		<p class="display-4 text-center">Categories</p>
		
        
			
		<div class="row m-4">
			<?php for($i=0;$i<8;$i=$i+2) { ?>
				<div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
					<div class="card text-center">
						<a href='sub_categories/sub_category.php?cat_id=<?=$c;?>&&cat_name=<?=$categories[$c-1];?>' class="stretched-link">
  						<img class="card-img-top" src="assets/categories/cat<?=$i+1?>.png" alt="Card image cap" style="width:16%;height:16%;">
  							<div class="card-body">
    								<h5 class="card-title"><?=$categories[$i];?></h5>
  							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-xs-6 col-sm-6 col-md-6">
					<div class="card">
						<a href='sub_categories/sub_category.php?cat_id=<?=$c;?>&&cat_name=<?=$categories[$c-1];?>' class="stretched-link">
  						<img class="card-img-top" src="assets/categories/cat<?=$i+2?>.png" alt="Card image cap" style="width:16%;height:16%;">
  							<div class="card-body">
    								<h5 class="card-title"><?=$categories[$i+1];?></h5>
  							</div>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
			
	</body>


<?php include_once 'footer.php'; ?>
