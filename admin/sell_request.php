<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 

		$con=getCon();
      
      	session_start(); 

      	/*if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
        	header("Location:../index.php");
            die(); 
      	}*/

      	$sell_request_main=$_GET['sell_request_main'];
	$status=$_GET['status'];
	$stock_variant=$_GET['stock_variant'];
	$admin_check_sell=$_GET['admin_check_sell'];
	$admin_reject_sell=$_GET['admin_reject_sell'];
	$admin_edit_sell=$_GET['admin_edit_sell'];

	$admin_verify_product=$_POST['admin_verify_product'];
	
	$variant_approve = $_GET['variant_approve'];
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
  
  
	
	 <div class="p-4 mb-4" style="background-color:black;color:white;">
        <div class="text-center">
              <h4>Seller requests</h4>
        </div>
    </div>
     
	<a class="btn btn-dark ml-4" href="admin_enter.php?admin_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
            
  
  	<?php
	
		if($sell_request_main=="yes") {
	
	?>
  
	
	<?php
	
		$con=getCon();
  		$sql="select * from store_info";
  
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
		$seller_user_name=array();
  
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
			$seller_user_name[]=$ele['seller_user_name'];
  		}
  
  		$n=count($store_info_id);	
			
	?>
	
	
	<?php
	
		$sql0 = "select * from store_info where approved=0";
		$res0i = $con->query($sql0);
		$res0 = $res0i->num_rows;
		//echo $res1;echo "<br>";
	
		$sql1 = "select * from store_info where approved=1";
		$res1i = $con->query($sql1);
		$res1 = $res1i->num_rows;
	
		$sql2 = "select * from store_info where approved=2";
		$res2i = $con->query($sql2);
		$res2 = $res2i->num_rows;
	
	
	?>
	
	
	<div class="text-center m-4">
            <a <?php if($status==0) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=0" role="button">Pending<span class="badge badge-light ml-2"><?=$res0;?></span></a>
	    <a <?php if($status==1) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=1&&stock_variant=yes" role="button">Approved<span class="badge badge-light ml-2"><?=$res1;?></span></a>
            <a <?php if($status==2) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=2" role="button">Rejected<span class="badge badge-light ml-2"><?=$res2;?></span></a>
	</div>
	
	
	
	<?php if($stock_variant!="yes") { ?>	
			
			<?php $q=0;$c=0;$cc=0; for($k=0;$k<$n;$k++) { ?>

				<?php if(($approved[$k]==2&&$status==2)||($approved[$k]==0&&$status==0)) { ?>
				
					<div class="card m-4 border-dark">
  					<div class="card-header" type="button" data-toggle="collapse" data-target="#collapse_m<?=$cc?>" aria-expanded="false" aria-controls="collapseExample">Sold by <?=$seller_user_name[$k]?>  </div>
  					
					<div class="collapse m-2" id="collapse_m<?=$cc?>">
						<div class="card-body">
						<p class="card-text">store_info_id : <?=$store_info_id[$k]?></p>
						<p class="card-text">product name : <?=$product_name[$k]?></p>
    						<p class="card-text">category : <?=$category[$k]?></p>
    						<p class="card-text">sub category : <?=$sub_category[$k]?></p>
    						<p class="card-text">product brand  : <?=$product_brand[$k]?></p>
    						<p class="card-text">product description : <?=$product_description[$k]?></p>					
	
    				<? if($approved[$k]==2&&$status==2) { ?>
					
					<p class="card-text">price : <?=$price[$k]?></p>
    					<p class="card-text">color : <?=$color[$k]?></p>
					<p class="card-text">size  : <?=$size[$k]?></p>	
							
					<p class="card-text">quantity : <?=$quantity[$k]?></p>
							
					<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-danger">Rejected</span></h6>
							
				<? } else if($approved[$k]==0&&$status==0){ ?>	
								
					<p class="card-text">price : <?=$price[$k]?></p>
    					<p class="card-text">color : <?=$color[$k]?></p>
					<p class="card-text">size  : <?=$size[$k]?></p>			
							
					<p class="card-text">quantity : <?=$quantity[$k]?></p>		
							
    					<h6 class="card-text">Status - waiting for Approval&nbsp&nbsp<div class="spinner-grow spinner-grow-sm" role="status"></div></h6>
							
					<a href='sell_request.php?admin_check_sell=yes&&admin_edit_sell=yes&&store_info_id=<?=$store_info_id[$k]?>' class="btn btn-success m-2">Edit and Approve</a>
    					<a href='sell_request.php?admin_check_sell=yes&&admin_reject_sell=yes&&store_info_id=<?=$store_info_id[$k]?>' name="reject_application" class="btn btn-danger m-2">Reject</a>
    
		
    				<? } ?>
				<? } ?>	
					</div>
				</div>
					
			</div>	
	
 		 	<?php $c++;$cc++; } ?>
	
		<?php } else if($stock_variant=="yes") { ?>
			
			<?php
	
				$approved_sql = "select c.cat_name,sc.sub_cat_name,p.product_id,s.seller_user_name,s.store_info_id,p.product_name,p.product_brand,p.product_description,up.unique_type_id,up.price,up.quantity,up.color,up.size from categories as c,sub_categories as sc,products as p,unique_product as up,store_info as s where s.store_unique_type_id=up.unique_type_id and p.product_id=up.product_id and p.sub_cat_id=sc.sub_cat_id and sc.cat_id=c.cat_id";
				$approved_res = $con->query($approved_sql);
				
				$approved_store_info_id=array();
				$approved_store_product_id=array();
				$approved_category=array();
				$approved_sub_category=array();
				$approved_product_name=array();
				$approved_product_brand=array();
				$approved_product_description=array();
				$approved_color=array();
				$approved_size=array();
				$approved_price=array();
				$approved_quantity=array();
				$approved_seller_user_name=array();
		
				while($approved_ele = $approved_res->fetch_assoc())
				{
					$approved_store_info_id[]=$approved_ele['store_info_id'];
					$approved_category[]=$approved_ele['cat_name'];
					$approved_sub_category[]=$approved_ele['sub_cat_name'];
					$approved_store_product_id[]=$approved_ele['product_id'];
					$approved_product_name[]=$approved_ele['product_name'];
					$approved_product_brand[]=$approved_ele['product_brand'];
					$approved_product_description[]=$approved_ele['product_description'];
					$approved_color[]=$approved_ele['color'];
					$approved_size[]=$approved_ele['size'];
					$approved_price[]=$approved_ele['price'];
					$approved_quantity[]=$approved_ele['quantity'];
					$approved_seller_user_name[]=$approved_ele['seller_user_name'];
				}
		
				$approved_count=count($approved_store_info_id);
			?>
	
	
			<?php
	
				//variant check
				//echo $variant_approve;
		
				$variant_approve_variant_id=$_GET['variant_id_v'];
		
				if($variant_approve=="no")
				{
					$con->query("update variant set variant_approved=2 where variant_id='$variant_approve_variant_id'");
				}
				else if($variant_approve=="yes")
				{
					$variant_approve_size=array();
					$variant_approve_color=array();
					$variant_approve_price=array();
					$variant_approve_quantity=array();
					$variant_approve_store_product_id=array();
					$variant_approve_store_info_id=array();
					
					$variant_approve_res =  $con->query("select * from variant where variant_id='$variant_approve_variant_id'");
					
					while($variant_approve_ele = $variant_approve_res->fetch_assoc())
					{
						$variant_approve_size[]=$variant_approve_ele['size'];
						$variant_approve_color[]=$variant_approve_ele['color'];
						$variant_approve_price[]=$variant_approve_ele['price'];
						$variant_approve_quantity[]=$variant_approve_ele['quantity'];
						$variant_approve_store_product_id[]=$variant_approve_ele['store_product_id'];
						$variant_approve_store_info_id[]=$variant_approve_ele['store_info_id'];
					}
					
					/*print_r($variant_approve_size[0]);echo "<br>";
					print_r($variant_approve_color[0]);echo "<br>";
					print_r($variant_approve_price[0]);echo "<br>";
					print_r($variant_approve_quantity[0]);echo "<br>";
					print_r($variant_approve_store_product_id[0]);echo "<br>";
					print_r($variant_approve_store_info_id[0]);echo "<br>";*/
					
					
					$variant_approve_seller_user_name = array();
					$variant_approve_seller_user_name_res = $con->query("select * from store_info where store_info_id='$variant_approve_store_info_id[0]'");
					while($variant_approve_seller_user_name_ele = $variant_approve_seller_user_name_res->fetch_assoc())
					{
						$variant_approve_seller_user_name[]=$variant_approve_seller_user_name_ele['seller_user_name']; 	
					}
					
					//echo "seller ".$variant_approve_seller_user_name[0];
					
					//to insert into unique_product table
					$con->query("insert into unique_product(product_id,price,quantity,seller_user_name,color,size) values('".mysqli_real_escape_string($con,$variant_approve_store_product_id[0])."',
					'".mysqli_real_escape_string($con,$variant_approve_price[0])."','".mysqli_real_escape_string($con,$variant_approve_quantity[0])."',
					'".mysqli_real_escape_string($con,$variant_approve_seller_user_name[0])."','".mysqli_real_escape_string($con,$variant_approve_color[0])."'
					,'".mysqli_real_escape_string($con,$variant_approve_size[0])."')");
					
					
					//to display dynamic content
					$variant_approve_store_unique_type_id=array();
					$variant_approve_store_unique_type_id_res = $con->query("select * from unique_product where product_id='$variant_approve_store_product_id[0]' and seller_user_name='$variant_approve_seller_user_name[0]' ORDER BY unique_type_id DESC LIMIT 1");
					while($variant_approve_store_unique_type_id_ele = $variant_approve_store_unique_type_id_res->fetch_assoc())
					{
						$variant_approve_store_unique_type_id[]=$variant_approve_store_unique_type_id_ele['unique_type_id']; 	
					}
					
					//to update variant
					$con->query("update variant set variant_approved=1,store_unique_type_id='$variant_approve_store_unique_type_id[0]' where variant_id='$variant_approve_variant_id'");
					
				}
				
			?>
			
	
	
			<?php $ac=0; for($ai=0;$ai<$approved_count;$ai++) { ?>
				
				<div class="card m-4 border-dark">
  					<div class="card-header" type="button" data-toggle="collapse" data-target="#collapse_m<?=$ac?>" aria-expanded="false" aria-controls="collapseExample">Product name : <?=$approved_product_name[$ai]?> - Sold by : <?=$approved_seller_user_name[$ai]?></div>
  					
						<div class="collapse m-2" id="collapse_m<?=$ac?>">
							
							<div class="card-body">
								<p class="card-text">store_info_id : <?=$approved_store_info_id[$ai]?></p>	
    							<p class="card-text">category : <?=$approved_category[$ai]?></p>
    							<p class="card-text">sub category : <?=$approved_sub_category[$ai]?></p>
    							<p class="card-text">product brand  : <?=$approved_product_brand[$ai]?></p>
    							<p class="card-text">product description : <?=$approved_product_description[$ai]?></p>	
							</div>
					
						<div class="col-12 col-sm-4">
							<div class="card border-dark m-4">
  								<div class="card-body">
									<p class="card-text">color : <?=$approved_color[$ai]?></p>
    								<p class="card-text">size  : <?=$approved_size[$ai]?></p>
    								<p class="card-text">price : <?=$approved_price[$ai]?></p>
									<p class="card-text">quantity : <?=$approved_quantity[$ai]?></p>
									<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-success">approved</span></h6>
								</div>
							</div>
						</div>
							
							
						<?php
							
							$variant_res = $con->query("select * from variant where store_info_id='$approved_store_info_id[$ai]'");
							
							$variant_approved_v=array();
							$variant_price_v=array();
							$variant_color_v=array();
							$variant_size_v=array();
							$variant_quantity_v=array();
							$variant_id_v=array();
									   
							$variant_store_product_id_v=array();
							$variant_store_unique_type_id_v=array();
							$variant_store_info_id_v=array();
															   
							while($variant_ele = $variant_res->fetch_assoc())
							{
								$variant_approved_v[]=$variant_ele['variant_approved'];
								$variant_price_v[]=$variant_ele['price'];
								$variant_color_v[]=$variant_ele['color'];
								$variant_size_v[]=$variant_ele['size'];
								$variant_quantity_v[]=$variant_ele['quantity'];
								$variant_id_v[]=$variant_ele['variant_id'];
								
								$variant_store_product_id_v[]=$variant_ele['store_product_id'];
								$variant_store_unique_type_id_v[]=$variant_ele['store_unique_type_id'];
								$variant_store_info_id_v[]=$variant_ele['store_info_id'];
							}
				
							$vc = count($variant_id_v);
									   
							
															   
						?>	
							
						<?php for($vi=0;$vi<$vc;$vi++) { ?>	
						<!--waiting variant start-->	
						<?php if($variant_approved_v[$vi]==0) { ?>
							<div class="col-12 col-sm-4">
								<div class="card border-dark m-4">
  									<div class="card-body">
										<p class="card-text">color : <?=$variant_color_v[$vi]?></p>
    									<p class="card-text">size  : <?=$variant_size_v[$vi]?></p>
    									<p class="card-text">price : <?=$variant_price_v[$vi]?></p>
										<p class="card-text">quantity : <?=$variant_quantity_v[$vi]?></p>
										<h6 class="card-text">Status&nbsp&nbsp: <span class="badge badge-info">processing</span></h6>
										<a class="btn btn-success btn-sm m-2" href="sell_request.php?sell_request_main=yes&&status=1&&stock_variant=yes&&variant_approve=yes&&variant_id_v=<?=$variant_id_v[$vi]?>" role="button">Approve Variant</a>
										<a class="btn btn-danger btn-sm m-2" href="sell_request.php?sell_request_main=yes&&status=1&&stock_variant=yes&&variant_approve=no&&variant_id_v=<?=$variant_id_v[$vi]?>" role="button">Reject Variant</a>
									</div>
								</div>
							</div>
						<?php } ?>
						<!--waiting variant end-->		
							
							
						<!--approved variant start-->
						<?php
							//to get details of approved products from unique_product
							$variant_price_v_up=array();
							$variant_color_v_up=array();
							$variant_size_v_up=array();
							$variant_quantity_v_up=array();	
							
							echo $variant_store_unique_type_id_v[$vi];			
										
							$variant_res_up = $con->query("select * from unique_product where unique_type_id='$variant_store_unique_type_id_v[$vi]'");
				 			
							print_r($variant_res_up->fetch_assoc());		   
									   
							while($variant_ele_up = $variant_res_up->fetch_assoc())
							{
								$variant_price_v_up[]=$variant_ele_up['price'];
								$variant_color_v_up[]=$variant_ele_up['color'];
								$variant_size_v_up[]=$variant_ele_up['size'];
								$variant_quantity_v_up[]=$variant_ele_up['quantity'];
							}	
							
						?>
							<?php if($variant_approved_v[$vi]==1) { ?>
							<div class="col-12 col-sm-4">
								<div class="card border-dark m-4">
  									<div class="card-body">
										<p class="card-text">color : <?=$variant_color_v_up[0]?></p>
    									<p class="card-text">size  : <?=$variant_size_v_up[0]?></p>
    									<p class="card-text">price : <?=$variant_price_v_up[0]?></p>
										<p class="card-text">quantity : <?=$variant_quantity_v_up[0]?></p>
										<h6 class="card-text">Status&nbsp&nbsp: <span class="badge badge-success">approved</span></h6>
									</div>
								</div>
							</div>
						<?php } ?>
						<!--approved variant end-->
					
						
	
						<!--rejected variant start-->
						<?php if($variant_approved_v[$vi]==2) { ?>
							<div class="col-12 col-sm-4">
								<div class="card border-dark m-4">
  									<div class="card-body">
										<p class="card-text">color : <?=$variant_color_v[$vi]?></p>
    									<p class="card-text">size  : <?=$variant_size_v[$vi]?></p>
    									<p class="card-text">price : <?=$variant_price_v[$vi]?></p>
										<p class="card-text">quantity : <?=$variant_quantity_v[$vi]?></p>
										<h6 class="card-text">Status&nbsp&nbsp: <span class="badge badge-danger">rejected</span></h6>
									</div>
								</div>
							</div>
						<?php } ?>
						<!--rejected variant end-->
						<?php } ?>
	
				
					</div>
				</div>
			</div>			
			
			<?php $ac++;} ?>
					
		<?php } ?>
	
	<?php } else if($admin_check_sell=="yes") { ?>
		
	
	<?php
	
		$check_store_info_id=$_GET['store_info_id'];				   
						   
		if($admin_reject_sell=="yes")
		{
			$con->query("update store_info set approved=2 where store_info_id='$check_store_info_id'");
			header("Location:sell_request.php?sell_request_main=yes");
                	die();
		}
	
		if($admin_edit_sell=="yes"){
      
      			//check by admin
        		$con=getCon();
        		$check_sql="select * from store_info where store_info_id='$check_store_info_id'";
    
        		$check_res=$con->query($check_sql);
  
  			$check_category=array();
  			$check_subcategory=array();
			$check_product_name=array();
  			$check_product_brand=array();
  			$check_product_description=array();
  			$check_price=array();
  			$check_quantity=array();
  			$check_color=array();
  			$check_size=array();
  			$check_approved=array();
  			$check_store_info_id=array();
  			$check_seller_name=array();
  
  			while($check_ele = $check_res->fetch_assoc())
  			{
      				$check_category[]=$check_ele['category'];
	      			$check_subcategory[]=$check_ele['sub_category'];
      				$check_product_name[]=$check_ele['product_name'];
      				$check_product_brand[]=$check_ele['product_brand'];
      				$check_product_description[]=$check_ele['product_description'];
      				$check_price[]=$check_ele['price'];
      				$check_quantity[]=$check_ele['quantity'];
      				$check_color[]=$check_ele['color'];
      				$check_size[]=$check_ele['size'];
      				$check_approved[]=$check_ele['approved'];
      				$check_store_info_id[]=$check_ele['store_info_id'];
      				$check_seller_name[]=$check_ele['seller_user_name'];
  			}				
  
  			$check_n=count($check_store_info_id);
      
      		}
			
		
		//to get product id
		$product_id_res=$con->query("select count(*) as pc from products");

		$product_id_c=Array();

		while($pic=$product_id_res->fetch_assoc())
			$product_id_c[]=$pic['pc'];

		$product_id_c_use=$product_id_c[0]+1;
		//
			
			
		//to get cat_id to fill in add category and subcategory
      		$cats_id=Array();
      		$cats_name=Array();
      		$sub_cats_id=Array();
      		$sub_cats_name=Array();
      		$cats_f=$con->query("select s.cat_id,s.cat_name,sc.sub_cat_id,sc.sub_cat_name from categories as s,sub_categories as sc where sc.cat_id=s.cat_id");
			
      		while($catt=$cats_f->fetch_assoc()){
           		$cats_id[]=$catt['cat_id'];
           		$cats_name[]=$catt['cat_name'];
	     		$sub_cats_id[]=$catt['sub_cat_id'];
           		$sub_cats_name[]=$catt['sub_cat_name'];
	        }

      		$cats=count($cats_id);
      		//   
      	
			
	?>
	
	
	
	
	
	
		<form class="jumbotron m-4" method="POST" action="sell_request.php">
         		<!--seller name-->
     			<div class="form-group">
        			<label for="inputsellername">Seller name</label>
        			<input type="text" class="form-control" id="inputsellername" placeholder="" value="<?=$check_seller_name[0]?>" name="seller_name" required>
    			</div>
         		<!--sub cat id-->
     			<div class="form-group">
	    			<label for="cat_name">category and sub category name</label>
    				<select class="form-control" id="qty" name="sub_cat_id">
		      			<?php for($i=0;$i<$cats;$i++) { ?>
    						<option value="<?=$sub_cats_id[$i]?>"><?=$cats_name[$i]?> - <?=$sub_cats_name[$i]?></option>
                      			<?php } ?>
    				</select>	
    			</div> 
         		<!--product id-->
     			<div class="form-group">
        			<label for="inputproduct_id">product id</label>
        			<input type="number" class="form-control" id="inputproduct_id" placeholder="product id" name="product_id" value="<?=$product_id_c_use?>">
    			</div>
         		<!--product name-->
    			<div class="form-group">
        			<label for="inputproduct_name">product name</label>
        			<input type="text" class="form-control" id="inputproduct_name" placeholder="" value="<?=$check_product_name[0]?>" name="product_name" required>
    			</div>
         		<!--product brand-->
    			<div class="form-group">
        			<label for="inputbrand">product brand</label>
        			<input type="text" class="form-control" id="inputbrand" placeholder="" value="<?=$check_product_brand[0]?>" name="product_brand" required>
    			</div>     
		        <!--product description-->
     			<div class="form-group">
        			<label for="inputdesc">product Description</label>
        			<input type="text" class="form-control" id="inputdesc" placeholder="" value="<?=$check_product_description[0]?>" name="product_description" required>
    			</div>    
         		<!--product rating-->
     			<div class="form-group">
        			<label for="inputrating">product rating</label>
        			<input type="number" class="form-control" id="inputrating" placeholder="rating" name="rating" value="0" disabled>
    			</div>     
         		<!--price-->
    			<div class="form-group">
        			<label for="inputprice">price</label>
        			<input type="number" class="form-control" id="inputprice" placeholder="" value="<?=$check_price[0]?>" name="price" required>
    			</div>     
         		<!--size-->
    			<div class="form-group">
        			<label for="inputsize">size</label>
        			<input type="text" class="form-control" id="inputsize" placeholder="" value="<?=$check_size[0]?>" name="size" required>
    			</div>
         		<!--color-->
    			<div class="form-group">
        			<label for="inputcolor">color</label>
			        <input type="text" class="form-control" id="inputcolor" placeholder="" value="<?=$check_color[0]?>" name="color" required>
    			</div>	
         		<!--quantity-->
    			<div class="form-group">
        			<label for="inputqty">quantity</label>
        			<input type="number" class="form-control" id="inputqty" placeholder="" value="<?=$check_quantity[0]?>" name="qty" required> 
    			</div>
         		<!--storeinfoid-->
    			<div class="form-group">
        			<label for="inputstoreinfoid">store info id</label>
        			<input type="number" class="form-control" id="inputstoreinfoid" placeholder="" value="<?=$check_store_info_id[0]?>" name="storeinfoid" required> 
    			</div>
         		<!--approve status-->
    			<div class="form-group">
        			<label for="inputapprove">approve status - [1/0]</label>
        			<input type="number" class="form-control" id="inputapprove" placeholder="" value="1" name="approve" required> 
    			</div>     
		       
    			<input type="hidden" name="verify_store_info_id" value="<?=$check_store_info_id[0]?>" />
			<input type="hidden" name="admin_verify_product" value="yes" />
	       
    			<button type="submit" name="verify_product" class="btn btn-dark">Approve</button>
    		</form>     		
	
	<?php } else if($admin_verify_product=="yes") { ?>
	
        	<?php  
			if(isset($_POST['verify_product']))
      			{
            			$con=getCon();

 				$subcategoryid=$_POST['sub_cat_id'];
      				$productid=$_POST['product_id'];
      				$productname=$_POST['product_name'];
      				$productbrand=$_POST['product_brand'];
      				$productdescription=$_POST['product_description'];
      				$price=$_POST['price'];
      				$quantity=$_POST['qty'];
      				$color=$_POST['color'];
      				$size=$_POST['size'];
      				$sellername=$_POST['seller_name'];
      				$rating=$_POST['rating'];          

     
  
      				//For Store info
      				$approved=$_POST['approve'];
      				$verify_store_info_id=$_POST['verify_store_info_id'];
      				//$done=1;      
				
      				//for updating store info
      				$sql1="update store_info set approved=1 where store_info_id='$verify_store_info_id'";
				
      				$sql2="insert into products(product_id,product_name,sub_cat_id,product_brand,product_description,rating) values('".mysqli_real_escape_string($con,$productid)."','".mysqli_real_escape_string($con,$productname)."','".mysqli_real_escape_string($con,$subcategoryid)."','".mysqli_real_escape_string($con,$productbrand)."','".mysqli_real_escape_string($con,$productdescription)."','".mysqli_real_escape_string($con,$rating)."')";
				
      				$sql3="insert into unique_product(product_id,price,quantity,seller_user_name,color,size) values('".mysqli_real_escape_string($con,$productid)."','".mysqli_real_escape_string($con,$price)."','".mysqli_real_escape_string($con,$quantity)."','".mysqli_real_escape_string($con,$sellername)."','".mysqli_real_escape_string($con,$color)."','".mysqli_real_escape_string($con,$size)."')";
      
				$sql4="update store_info set store_product_id='".mysqli_real_escape_string($con,$productid)."',store_unique_type_id = (select unique_type_id from unique_product where product_id='$productid' and seller_user_name='$sellername') where store_info_id='$verify_store_info_id'";
	
	      
      				if($con->query($sql2)===True)
      				{
        				if($con->query($sql3)===True)
        				{
          					if($con->query($sql1)===True)
         				 	{
	   						if($con->query($sql4)===True)
							{	
              							header("Location:sell_request.php?sell_request_main=yes&&status=1&&stock_variant=yes");
                						die();
						        }
        					}					
      					}
				}
      				else
      				{
        				echo "something went wrong"; 
      				}  
            
      			}
		?>
	
	<?php } ?>
  
  
  
</body>
<?php include_once '../footer.php'; ?>
