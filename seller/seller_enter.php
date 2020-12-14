<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	} 


		$con=getCon();

      
      $seller_enter_main=$_GET['seller_enter_main'];
      $sell_a_product=$_GET['sell_a_product'];
      $my_sell_requests=$_GET['my_sell_requests'];

      $categories=Array();
      $sub_categories=Array();

      $res1=$con->query("select * from categories");
      while($ele1=$res1->fetch_assoc())
      {
            $categories[]=$ele1['cat_name'];     
      }

      $res2=$con->query("select * from sub_categories");
      while($ele2=$res2->fetch_assoc())
      {
            $sub_categories[]=$ele2['sub_cat_name'];     
      }

      $c=count($categories);
      $sc=count($sub_categories);



		if(isset($_POST['sell_a_product']))
		{
				$approved=0;
      			$seller=$_SESSION['user_name'];
      			$category=$_POST['cat'];
      			$subcategory=$_POST['subcat'];
      			$product=$_POST['pro'];
      			$description=$_POST['desc'];
      			$quantity=$_POST['qty'];
      			$brand=$_POST['brand'];
      			$size=$_POST['size'];
      			$color=$_POST['color'];
      			$price=$_POST['price'];
			
        		if(($con->query("insert into store_info(seller_user_name,category,sub_category,product_name,product_brand,product_description,price,quantity,color,size,approved) values('".mysqli_real_escape_string($con,$seller)."','".mysqli_real_escape_string($con,$category)."','".mysqli_real_escape_string($con,$subcategory)."','".mysqli_real_escape_string($con,$product)."','".mysqli_real_escape_string($con,$brand)."','".mysqli_real_escape_string($con,$description)."','".mysqli_real_escape_string($con,$price)."','".mysqli_real_escape_string($con,$quantity)."','".mysqli_real_escape_string($con,$color)."','".mysqli_real_escape_string($con,$size)."','".mysqli_real_escape_string($con,$approved)."')"))===True){
                
                	header("Location:seller_enter.php?seller_enter_main=yes");
                	die();
        		}
        		else
        		{
            		header("Location:seller_enter.php");
                	die();
        		}
		}
		

		if($my_sell_requests=="yes")
		{
				$seller=$_SESSION['user_name'];
  				$con=getCon();
  				$sql="select * from store_info where seller_user_name='$seller'";
  
  				$res=$con->query($sql);
  
  				$category=array();
 	 			$subcategory=array();
  				$product_name=array();
  				$product_brand=array();
  				$product_description=array();
  				$price=array();
  				$quantity=array();
  				$color=array();
  				$size=array();
  				$approved=array();
  				$storeinfoid=array();
	
  
  				while($ele = $res->fetch_assoc())
  				{
      					$category[]=$ele['category'];
      					$subcategory[]=$ele['sub_category'];
      					$product_name[]=$ele['product_name'];
      					$product_brand[]=$ele['product_brand'];
      					$product_description[]=$ele['product_description'];
      					$price[]=$ele['price'];
      					$quantity[]=$ele['quantity'];
      					$color[]=$ele['color'];
      					$size[]=$ele['size'];
      					$approved[]=$ele['approved'];
      					$storeinfoid[]=$ele['store_info_id'];
  				}
  
  				$n=count($product_name);
	
		}
      

?>


<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">ShopShop</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="../pages/about.php" class="nav-item nav-link">About</a>
        </div>
        <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])){
                    echo '<a href="../pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o"> '.$_SESSION['user_name'].'</i></a>';
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


      <?php if($seller_enter_main=="yes") { ?>
	
      	    <div class="text-center m-4">
            	<a class="btn btn-primary" href="seller_enter.php?sell_a_product=yes" role="button">Sell a product</a>
            	<a class="btn btn-primary" href="seller_enter.php?my_sell_requests=yes" role="button">My sell requests</a>
	   	 	</div>
	
      <?php } else if($sell_a_product=="yes") { ?>
      		
            <a class="btn btn-primary m-4" href="seller_enter.php?my_sell_requests=yes" role="button">My sell requests</a>
            <form class="jumbotron m-4" method="POST" action="seller_enter.php">
		  			<label for="category">Category</label>
                  	<div class="form-group">
    					<select class="form-control" id="category" name="cat">
							<option value="notselected">Choose...</option>
                              	<?php for($i=0;$i<$c;$i++) { ?>
					      			<option value="<?=$categories[$i]?>"><?=$i+1?> - <?=$categories[$i]?></option>
				      			<?php } ?>
    					</select>
  		  			</div>
		  			<label for="sub_category">Sub_Category</label>
                  	<div class="form-group">
    						<select class="form-control" id="category" name="subcat">
								<option value="notselected">Choose...</option>
                              	<?php for($j=0;$j<$sc;$j++) { ?>
					      			<option value="<?=$sub_categories[$j]?>"><?=$j+1?> - <?=$sub_categories[$j]?></option>
								<?php } ?>
    						</select>
  		   			</div>
					<div class="form-group">
        				<label for="inputpro">product</label>
        					<input type="text" class="form-control" id="inputpro" placeholder="product name" name="pro" required>
    		   		</div>
    		   		<div class="form-group">
        				<label for="inputdesc">Description</label>
        					<input type="text" class="form-control" id="inputdesc" placeholder="product description" name="desc" required>
    				</div>
    				<div class="form-group">
        				<label for="inputbrand">brand</label>
        					<input type="text" class="form-control" id="inputbrand" placeholder="product brand" name="brand" required>
    				</div>
    				<div class="form-group">
        				<label for="inputsize">size</label>
        					<input type="text" class="form-control" id="inputsize" placeholder="size" name="size" required>
    				</div>
    				<div class="form-group">
        				<label for="inputcolor">color</label>
        					<input type="text" class="form-control" id="inputcolor" placeholder="color" name="color" required>
    				</div>
    				<div class="form-group">
        				<label for="inputcolor">Price</label>
        					<input type="number" class="form-control" id="inputprice" placeholder="price" name="price" required>
    				</div>
    				<div class="form-group">
        				<label for="inputqty">quantity</label>
        					<input type="number" class="form-control" id="inputqty" placeholder="quantity" name="qty" required>
    				</div>
    				
					<button type="submit" name="sell_a_product" class="btn btn-dark">Sell product</button>
    		</form>
      
      <?php } else if($my_sell_requests=="yes") { ?>
      		
            <a class="btn btn-primary m-4" href="seller_enter.php?sell_a_product=yes" role="button">Sell a product</a>
	
			<? for($k=0;$k<$n;$k++) { ?>
				<div class="card m-4">
  					<div class="card-header">Product name : <?=$product_name[$k]?></div>
  					<div class="card-body">
    					<p class="card-text">category : <?=$category[$k]?></p>
    					<p class="card-text">sub category : <?=$sub_category[$k]?></p>
    					<p class="card-text">product brand  : <?=$product_brand[$k]?></p>
    					<p class="card-text">product description : <?=$product_description[$k]?></p>
    					<p class="card-text">price : <?=$price[$k]?></p>
    					<p class="card-text">color : <?=$color[$k]?></p>
    					<p class="card-text">size  : <?=$size[$k]?></p>
    					<p class="card-text">quantity : <?=$quantity[$k]?></p>
    
    				<? if($approved[$k]) { ?>
    					<h6 class="card-text">Approved&nbsp&nbsp<span class="badge badge-success">Success</span></h6>
    				<? } else { ?>
    					<h6 class="card-text">waiting for Approval&nbsp&nbsp<div class="spinner-grow spinner-grow-sm" role="status"></div></h6>
    				<? } ?>
    
    				<a href="#" class="btn btn-primary">Edit</a>
    				<a href="#" class="btn btn-primary">delete</a>

				</div>
			</div>  
 		 <? } ?>
	
      <?php } ?>
  

      
      
  
</body>
      
      






<?php include_once '../footer.php'; ?>