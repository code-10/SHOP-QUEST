
<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

        if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	} 

	$user = $_SESSION['user_name'];

		$con=getCon();

      
      	$seller_enter_main=$_GET['seller_enter_main'];
      	$sell_a_product=$_GET['sell_a_product'];
      	$my_sell_requests=$_GET['my_sell_requests'];
	$stock_variant=$_GET['stock_variant'];
	$edit=$_GET['edit'];
	$store_info_id_a=$_GET['store_info_id_a'];
	$store_info_id_d=$_GET['store_info_id_d'];
	$show_stat=$_GET['show_stat'];






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
 	 			$sub_category=array();
  				$product_name=array();
  				$product_brand=array();
  				$product_description=array();
  				$price=array();
  				$quantity=array();
  				$color=array();
  				$size=array();
  				$approved=array();
  				$store_info_id=array();
				$store_product_id=array();
				$store_unique_type_id=array();
				$stock_quantity=array();
				$stock_quantity_status=array();
  
  				while($ele = $res->fetch_assoc())
  				{
      					$category[]=$ele['category'];
      					$sub_category[]=$ele['sub_category'];
      					$product_name[]=$ele['product_name'];
      					$product_brand[]=$ele['product_brand'];
      					$product_description[]=$ele['product_description'];
      					$price[]=$ele['price'];
      					$quantity[]=$ele['quantity'];
      					$color[]=$ele['color'];
      					$size[]=$ele['size'];
      					$approved[]=$ele['approved'];
      					$store_info_id[]=$ele['store_info_id'];
					$store_unique_type_id[]=$ele['store_unique_type_id'];
					$stock_quantity[]=$ele['stock_quantity'];
					$stock_quantity_status[]=$ele['stock_quantity_status'];
					$store_product_id[]=$ele['store_product_id'];
  				}
  
  				$n=count($product_name);
	
		}



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
            	<a class="btn btn-primary" href="seller_enter.php?my_sell_requests=yes&&show_stat=0" role="button">My sell requests</a>
	   </div>
	
      <?php } else if($sell_a_product=="yes") { ?>
      		
	    			<a class="btn btn-dark m-4" href="seller_enter.php?seller_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
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
      		
            <a class="btn btn-dark m-4" href="seller_enter.php?seller_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
	
	<?php
	
		$user = $_SESSION['user_name'];
	
		$sql0 = "select * from store_info where approved=0 and seller_user_name='$user'";
		$res0i = $con->query($sql0);
		$res0 = $res0i->num_rows;
		//echo $res0;echo "<br>";
	
		$sql1 = "select * from store_info where approved=1 and seller_user_name='$user'";
		$res1i = $con->query($sql1);
		$res1 = $res1i->num_rows;
		//echo $res1;echo "<br>";
	
		$sql2 = "select * from store_info where approved=2 and seller_user_name='$user'";
		$res2i = $con->query($sql2);
		$res2 = $res2i->num_rows;
		//echo $res2;echo "<br>";	
	
	?>
	
	
	<div class="text-center m-4">
            <a <?php if($show_stat==0) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="seller_enter.php?my_sell_requests=yes&&show_stat=0" role="button">Pending<span class="badge badge-light ml-2"><?=$res0;?></span></a>
	    <a <?php if($show_stat==1) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="seller_enter.php?my_sell_requests=yes&&show_stat=1&&stock_variant=yes" role="button">Approved <span class="badge badge-light ml-2 mr-2"><?=$res1;?></span></a>
            <a <?php if($show_stat==2) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="seller_enter.php?my_sell_requests=yes&&show_stat=2" role="button">Rejected<span class="badge badge-light ml-2"><?=$res2;?></span></a>
	</div>
			
		<?php if($stock_variant!="yes") { ?>	
			
			<?php $q=0;$c=0;$cc=0; for($k=0;$k<$n;$k++) { ?>

				<?php if(($approved[$k]==2&&$show_stat==2)||($approved[$k]==0&&$show_stat==0)) { ?>

					<div class="card m-4 border-dark">
  					<div class="card-header" type="button" data-toggle="collapse" data-target="#collapse_m<?=$cc?>" aria-expanded="false" aria-controls="collapseExample">Product name : <?=$product_name[$k]?> <strong><?php if($stock_quantity_status[$k]==1) { ?> <span class="badge badge-warning ml-2">Stock Request - Awaiting Admin</span> <?php } ?></strong></div>
  					
					<div class="collapse m-2" id="collapse_m<?=$cc?>">
						<div class="card-body">
						<p class="card-text">store_info_id : <?=$store_info_id[$k]?></p>	
    						<p class="card-text">category : <?=$category[$k]?></p>
    						<p class="card-text">sub category : <?=$sub_category[$k]?></p>
    						<p class="card-text">product brand  : <?=$product_brand[$k]?></p>
    						<p class="card-text">product description : <?=$product_description[$k]?></p>					
	
    				<? if($approved[$k]==2&&$show_stat==2) { ?>
					
					<p class="card-text">price : <?=$price[$k]?></p>
    					<p class="card-text">color : <?=$color[$k]?></p>
					<p class="card-text">size  : <?=$size[$k]?></p>	
							
					<p class="card-text">quantity : <?=$quantity[$k]?></p>
							
					<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-danger">Rejected</span></h6>
							
				<? } else if($approved[$k]==0&&$show_stat==0){ ?>	
								
					<p class="card-text">price : <?=$price[$k]?></p>
    					<p class="card-text">color : <?=$color[$k]?></p>
					<p class="card-text">size  : <?=$size[$k]?></p>			
							
					<p class="card-text">quantity : <?=$quantity[$k]?></p>		
							
    					<h6 class="card-text">Status - waiting for Approval&nbsp&nbsp<div class="spinner-grow spinner-grow-sm" role="status"></div></h6>
    				<? } ?>
				<? } ?>	
					</div>
				</div>
					
			</div>	
	
 		 	<?php $c++;$cc++; } ?>
	
		<?php } else if($stock_variant=="yes") { ?>
	
			<?php
	
				$approved_sql = "select c.cat_name,sc.sub_cat_name,p.product_id,s.store_info_id,p.product_name,p.product_brand,p.product_description,up.unique_type_id,up.price,up.quantity,up.color,up.size from categories as c,sub_categories as sc,products as p,unique_product as up,store_info as s where s.store_unique_type_id=up.unique_type_id and p.product_id=up.product_id and p.sub_cat_id=sc.sub_cat_id and sc.cat_id=c.cat_id and s.seller_user_name='$user'";
				$approved_res = $con->query($approved_sql);
				
				$approved_store_info_id=array();
				$approved_category=array();
				$approved_sub_category=array();
				$approved_product_name=array();
				$approved_product_brand=array();
				$approved_product_description=array();
		
				while($approved_ele = $approved_res->fetch_assoc())
				{
					$approved_store_info_id[]=$approved_ele['store_info_id'];
					$approved_category[]=$approved_ele['cat_name'];
					$approved_sub_category[]=$approved_ele['sub_cat_name'];
					$approved_product_name[]=$approved_ele['product_name'];
					$approved_product_brand[]=$approved_ele['product_brand'];
					$approved_product_description[]=$approved_ele['product_description'];
				}
		
				$approved_count=count($approved_store_info_id);
			?>
	
	
			<?php $ac=0; for($ai=0;$ai<$approved_count;$ai++) { ?>
				
				<div class="card m-4 border-dark">
  					<div class="card-header" type="button" data-toggle="collapse" data-target="#collapse_m<?=$ac?>" aria-expanded="false" aria-controls="collapseExample">Product name : <?=$product_name_a[$ai]?></div>
  					
						<div class="collapse m-2" id="collapse_m<?=$ac?>">
							<div class="card-body">
								<p class="card-text">store_info_id : <?=$approved_store_info_id[$ai]?></p>	
    								<p class="card-text">category : <?=$approved_category[$ai]?></p>
    								<p class="card-text">sub category : <?=$approved_sub_category[$ai]?></p>
								<p class="card-text">product name  : <?=$approved_product_name[$ai]?></p>
    								<p class="card-text">product brand  : <?=$approved_product_brand[$ai]?></p>
    								<p class="card-text">product description : <?=$approved_product_description[$ai]?></p>	
							</div>
						</div>
					
						
					
					</div>				
								
				</div>
	
			<?php $ac++; } ?>
			
			
	
      		<?php } ?>
	
	
	<?php } ?>
	
	
	
  

      
      
  
</body>
      
      






<?php include_once '../footer.php'; ?>
