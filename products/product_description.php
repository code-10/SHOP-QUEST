<?php include_once '../header.php'; ?>

<?php
	
	
    session_start();
	$user=$_SESSION['user_name'];
    include_once '../libraries/chocolates.php';
	$con=getCon();
    
    $product_id=$_GET['product_id'];
    $product_name=$_GET['product_name'];


	if(isset($_SESSION['user_name']))
	{
		$check=$con->query("select number_of_times_viewed from user_viewed where product_id='$product_id' and user_name='$user'");
		if($check->num_rows>0){
		
			$notvu=$con->query("select number_of_times_viewed from user_viewed where product_id='$product_id' and user_name='$user'");
			$notvcu=Array();
			while($getcount=$notvu->fetch_assoc())
				$notvcu[]=$getcount['number_of_times_viewed'];
			$notvccu=$notvcu[0]+1;
			$con->query("update user_viewed set number_of_times_viewed='$notvccu',user_name='$user' where product_id='$product_id' and user_name='$user'");
		
		}
		else{
		
			$con->query("insert into user_viewed(user_name,product_id,number_of_times_viewed) values('$user','$product_id',1)");
		
		}
		
	}


	//most viewed
	if(rowExists('most_viewed','product_id',$product_id)){
		
		$notv=$con->query("select number_of_times_viewed from most_viewed where product_id='$product_id'");
		$notvc=Array();
		while($getcount=$notv->fetch_assoc())
			$notvc[]=$getcount['number_of_times_viewed'];
		$notvcc=$notvc[0]+1;
		$con->query("update most_viewed set number_of_times_viewed='$notvcc' where product_id='$product_id'");
		
	}
	else{
		
		$con->query("insert into most_viewed(product_id,number_of_times_viewed) values('$product_id',1)");
		
	}
	//most viewed	
	

    $itsprice=$_GET['price'];
    $show = $_GET['show'];
  
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
					<div id="search" class="mb-2" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="../pages/search.php" class="form-inline input-group d-flex justify-content-center" style="padding:0.60rem!important">
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
  
     $nolog=$_GET['nolog'];
     $nostock=$_GET['nostock'];
     $buy=$_GET['buy'];
     $addtocart=$_GET['addtocart'];
     $wish=$_GET['wish'];
  
    
    $con = getCon();
    $res1= $con->query("select * from products where product_id='$product_id'");
  
    $product_description=Array();
    $product_price=Array();
    $product_rating=Array();
    $product_brand=Array();
    $product_rating_no=Array();
        
    while($ele = $res1->fetch_assoc())
    {
        $product_description=$ele['product_description'];
        $product_price=$ele['price'];
        $product_rating=$ele['rating'];
        $product_brand=$ele['product_brand'];
	$product_rating_no[]=$ele['rating_no'];
    }
    
    	$n=count($product_description);
	
     if(isset($_SESSION['user_name']))
     {
	$nolog=False;     
     }
	
	
     //to check if wishlisted
       
	$user=$_SESSION['user_name'];
	$wish=$con->query("select user_name from wishlist where product_id='$product_id' and user_name='$user'");

       

  
	
	//to display unique_products
	$res2=$con->query("select * from unique_product where product_id='$product_id'");
	
	$product_price=Array();
	$product_color=Array();
	$product_size=Array();
	$unique_type_id=Array();
	$product_seller=Array();
	
	while($ele = $res2->fetch_assoc())
	{
		$product_price[]=$ele['price'];
		$product_color[]=$ele['color'];
		$product_size[]=$ele['size'];
		$unique_type_id[]=$ele['unique_type_id'];
		$product_seller[]=$ele['seller_user_name'];
	}
	
	$t=count($unique_type_id);
	
	$remaining_quantity=$con->query("select quantity from unique_product where unique_type_id='$unique_type_id[$show]'")->fetch_assoc()['quantity'];
	
	$product_description_cart=true;
	
  ?>
  
  
  
<div class="container">
  <div class="text-center">
    <? if($nolog)
          echo "<h5 class='animate__animated animate__fadeOut' style='--animate-duration: 24s;'><div class='alert alert-warning' role='alert'>You are not logged in &nbsp;&nbsp;<a href='../sign_in/sign_in.php' style='font-size:16px;'>login</a></div></h4>";
       if(isset($_SESSION['user_name'])){
	        if($addtocart=="yes")
			 echo "<h5 id='addedtocart' class='animate__animated animate__fadeOut' style='--animate-duration: 4s;'><div class='alert alert-success' role='alert'>Added to cart</div></h4>"; 
		if($wish=="yes")
          		echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 4s;'>Wishlisted</h4>";
      		else if($wish=="no")
          		echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 4s;'>Not in Wishlist</h4>";
	      	           
      }
    ?>
  </div>
</div>
  
	
  
    
    
    <div class="text-center m-4">
	
	
		<div class="row">
			<div class="col-lg-6 col-xs-2 col-sm-2 col-md-6">
				<img src="../assets/categories/sub_categories/mobile/<?=$product_id?>.<?=$product_id?>.jpeg" class="img-fluid" alt="product" onerror="this.src='../assets/black.png';">
			</div>
			
			<div class="col-lg-6 col-xs-2 col-sm-2 col-md-6">
				
                	<div class="card-body p-1 m-1">
                    	<h5 class="card-title text-center mt-2" style="font-size:40px;"><?=$product_name;?>
			    <?php if($wish->num_rows>0) 
					echo '<a class="ml-2" href="wishlist.php?product_id='.$product_id.'&&product_name='.$product_name.'&&wishdo=no&&show='.$show.'&&product_description_page=yes"><i class="fa fa-heart" style="color:#ff008a"></i></a>';
			    	else
					echo '<a class="ml-2" href="wishlist.php?product_id='.$product_id.'&&product_name='.$product_name.'&&wishdo=yes&&show='.$show.'&&product_description_page=yes"> <i class="fa fa-heart-o" style="color:#a9a9a9"></i></a>';
			    ?>
		    	</h5>	
			<h4 class="text-center mt-2" style="font-size:24px;"><?=$product_color[$show]?>, <?=$product_size[$show]?></h4>
				
                    <h5 class="card-text ml-4 mr-4">Rating : <?=$product_rating;?> (<?=round($product_rating_no[0],2);?>) </h5>
		    <h4 class="card-text ml-4 mr-4 mb-4">Price : <i class="fa fa-rupee"></i> <?=$product_price[$show];?></h4>	
                    <p class="card-text ml-4 mr-4">Brand : <?=$product_brand;?> | Seller : <?=$product_seller[$show]?></p>
                    		
		    
                    <!--variants-->
		    <button class="btn btn-primary mb-4" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    			Options
		    </button>
			
				
		    <div class="collapse ml-2 mr-2 mt-4 mb-4" id="collapseExample">
  			<div id="here" class="card card-body">
				<div class="row">
					<? $c=0; for($i=1;$i<=4;$i++){ ?> 
    					<? if(4*($j-1)+$i>$n) break; ?>
						<div class="col-md-6 col-lg col-xl col-6">
							
							<figure class="figure">
        							<a href='product_description.php?product_id=<?=$product_id?>&&product_name=<?=$product_name?>&&show=<?=$c?>'>
          								<img src="..." class="figure-img img-fluid rounded mx-auto d-block" style="width:60%;height:50%;" alt="product" onerror="this.src='../assets/black.png';">
									<p style="margin-bottom:0px;color:black;"><?=$product_color[$c];?>, <?=$product_size[$c];?></p>
									<p style="margin-bottom:0px;color:black;"><?=$product_price[$c];?></p>
        							</a>
      							</figure>	
							
						</div>
   					<? $c++; if($c>=$t) break; } ?>
				</div>
  			</div>
		    </div>
		    <!--variants-->
			
		<form method="POST" action="cart.php">
		<!--buy and add to cart-->
		    <div class="row">
			    <div class="col-3"></div>
			    <div class="col-6 text-left">
				    <?php if($remaining_quantity<=0) { ?>
					<h4 class="card-text ml-4 mr-4 text-center">OUT OF STOCK</h4>
				    	<h4 class="card-text ml-4 mr-4 text-center">Choose other Options</h4>
			    	    <?php } else { ?>
				    Quantity
			    	    <div class="form-group">
    						<select class="form-control" id="qty" name="quantity">
							<?php $loop=min($remaining_quantity,4); for($i=1;$i<=$loop;$i++) { ?>
      								<option value="<?=$i?>"><?=$i?></option>
					    		<?php } ?>
    						</select>
  				    </div>
			    	    <?php } ?>
			    </div>
			    <div class="col-3"></div>
		    </div>
		    
		    <?php if($remaining_quantity>0) { ?>
		    <div class="row">
			    <div class="col-3"></div>
			    <div class="col-6">
				    <button class="btn btn-dark btn-block mb-4" type="submit" name="buy">Buy</button>
			    </div>
			    <div class="col-3"></div>
		    </div>
		    <div class="row">
			    <div class="col-3"></div>
			    <div class="col-6">
				    <button class="btn btn-dark btn-block mb-4" type="submit" name="addtocart">Add to cart</button>
			    </div>
			    <div class="col-3"></div>
		    </div>	
			<?php } ?>
			<input type="hidden" name="product_description_cart" value="<?=$product_description_cart?>" />
			<input type="hidden" name="unique_type_id" value="<?=$unique_type_id[$show]?>" />
			<input type="hidden" name="show" value="<?=$show?>" />
			<input type="hidden" name="product_id" value="<?=$product_id?>" />
			<input type="hidden" name="product_name" value="<?=$product_name?>" />
				</form>
		<!--buy and add to cart end-->
				
                    
                    <div class="row m-4">
                        <p class="p-4 text-left">Description : <?=$product_description;?></p>
                    </div>
				
				
		    <?php   
				
			$review=$con->query("select up.product_id,oc.review,o.user_name from unique_product as up,orders as o,order_contents as oc where up.unique_type_id=oc.unique_type_id and o.order_id=oc.order_id  and product_id='$product_id' and oc.review is not null group by o.user_name;");	
			
			$rd=Array();
			$run=Array();
				
			while($ro=$review->fetch_assoc())
			{
				$rd[]=$ro['review'];
				$run[]=$ro['user_name'];
			}
				
			$rc=count($rd);
				
			//print_r($rd);
			//print_r($run);
				
		    ?>	
				
			
		    <?php if($rc>0) { ?>
			
				<h5 class="text-center">Reviews</h5>	
				
			<ul class="list-group list-group-flush">
				<?php for($f=0;$f<$rc;$f++) { ?>
  					<li class="list-group-item"><?=$run[$f]?> - <?=$rd[$f]?></li>
				<?php } ?>
			</ul>	
				
		    <?php } ?>
                    
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
