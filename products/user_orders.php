<?php 
	include_once '../header.php';
	session_start(); 
	include_once '../libraries/chocolates.php';

	$con=getCon();

	$user=$_SESSION['user_name'];
	

	//differentiate and inputs
	$order_id_detail=$_GET['order_id_detail'];
	$order_details=$_GET['order_details'];
	$order_placed=$_GET['order_placed'];
	$your_orders=$_GET['your_orders'];
		

	/*if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	}*/ 



	//orders
	if($your_orders=="yes")
	{
		$res=$con->query("select * from orders where user_name='$user' order by order_date desc");
		$order_id=Array();
		$order_date=Array();
		$total_price=Array();
		while($ele=$res->fetch_assoc())
		{
			$order_id[]=$ele['order_id'];
			$order_date[]=$ele['order_date'];
			$total_price[]=$ele['total_price'];
		}
	
		$count_orders=count($order_id);
	}






	//view details of order
	if($order_details=="yes"){
	
		$res2=$con->query("select p.product_name,up.unique_type_id,p.product_id,up.color,up.size,oc.qty,oc.o_rating,oc.review,(oc.qty*up.price) as total_price from products as p,unique_product as up,order_contents as oc,orders as o where oc.order_id=o.order_id and oc.unique_type_id=up.unique_type_id and p.product_id=up.product_id and o.user_name='$user' and oc.order_id='$order_id_detail'");
	
		$product_id=Array();
		$product_name=Array();
		$product_color=Array();
		$product_size=Array();
		$product_qty=Array();
		$product_total_price=Array();
		$product_rating=Array();
		$product_review=Array();
		$unique_type_id=Array();

		while($ele2=$res2->fetch_assoc())
		{
			$product_id[]=$ele2['product_id'];
			$product_name[]=$ele2['product_name'];
			$product_color[]=$ele2['color'];
			$product_size[]=$ele2['size'];
			$product_qty[]=$ele2['qty'];
			$product_total_price[]=$ele2['total_price'];
			$product_rating[]=$ele2['o_rating'];
			$product_review[]=$ele2['review'];
			$unique_type_id[]=$ele2['unique_type_id'];
		}

		$order_details_count=count($product_id);
		
		
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
	
	<?php if($order_placed=="yes") { ?>
		<div class="container">
			<h4 class="text-center m-4 alert alert-success">Your Order is successful, Thank you.</h4>
			<h4 class="text-center m-2"><a href="../products/user_orders.php?your_orders=yes"><button type="button" class="btn btn-dark">Check your Orders</button></a></h4>
			<h4 class="text-center m-2"><a href="../index.php"><button type="button" class="btn btn-dark">Continue Shopping</button></a></h4>
		</div>
        <?php } else if($your_orders=="yes") { ?>
	
		<?php 
					
					$status=Array();
					$statusoforder = $con->query("select status from orders where user_name='$user' order by order_date desc");
					while($elesoc=$statusoforder->fetch_assoc())
						$status[]=$elesoc['status'];
					$soc=count($status);
						       
		?>
	
		<?php for($i=0;$i<$count_orders;$i++) { ?>
		<div class="row m-4 d-flex justify-content-center">
			<div class="col-lg-2 col-12 col-md-2 text-center">
				<p style="margin-top=0;margin-bottom:0;"><?=$order_id[$i]?></p>
			</div>
			<div class="col-lg-2 col-12 col-md-2 text-center">
				<p style="margin-top=0;margin-bottom:0;"><?=$order_date[$i]?>
			</div>
			<div class="col-lg-2 col-12 col-md-2 text-center">
				<p style="margin-top=0;margin-bottom:0;"><?=$total_price[$i]?></p>
			</div>
			<div class="col-lg-2 col-12 col-md-2 text-center">
				<a href="user_orders.php?order_details=yes&&order_id_detail=<?=$order_id[$i]?>"><button class="btn btn-dark">View details</button></a>
			</div>
			<div class="col-lg-2 col-12 col-md-2 text-center">
				
			
				<?php if($status[$i]==0){ ?>
					<div class="spinner-grow text-primary" role="status">
  						<span class="sr-only">Loading...</span>
					</div>
				<?php } else { ?>
					<span class="badge badge-success">Delivered</span>
				<?php } ?>
				
			</div>
		</div>
		<hr>
		<? } ?>	
	<?php } else if($order_details=="yes") { ?>
	
		<div class="row m-4 d-flex justify-content-center">
			<?php $c=0; for($j=0;$j<$order_details_count;$j++) { ?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-12">
					<div class="card m-2">
  					<div class="card-body">
    						<h5 class="card-title">Product name : <?=$product_name[$j]?></h5>
						<p class="card-text">Product color : <?=$product_color[$j]?></p>
						<p class="card-text">Product Specification : <?=$product_size[$j]?></p>
    						<p class="card-text">Quantity : <?=$product_qty[$j]?></p>
						<p class="card-text">Total price : <?=$product_total_price[$j]?></p>
						<p class="card-text">Product rating : <?=$product_rating[$j]?></p>
						<p class="card-text">Product review : <?=$product_review[$j]?></p>
						
						
						<!--rate and review-->
						<button class="btn btn-primary btn-sm ml-2" style="display:block;" type="button" data-toggle="collapse" data-target="#collapse<?=$j?>" aria-expanded="false" aria-controls="collapseExample">
    							Rate and Review
  						</button>
						<div class="collapse m-2" id="collapse<?=$j?>">
  							<div class="card card-body" style="padding:8px;">
								<form method="POST" action="rateandreview.php" class="input-group d-flex justify-content-center">
									<p>Rating</p>
								<div class="form-group m-2 col-12">
									<input type="hidden" name="unique_type_id" value="<?=$unique_type_id[$j]?>" />
									<input type="hidden" name="order_id_rate" value="<?=$order_id_detail?>" />
  									<input type="number" min="1" max="5" class="form-control" name="rating" placeholder="Your rating" aria-label="Rating" aria-describedby="basic-addon2" required>
								</div>
									<p>Review</p>
								<div class="form-group m-2 col-12">
    									<textarea class="form-control" id="review" rows="3"  cols="100" placeholder="Your review" name="review"></textarea>
  								</div>
									
								<button class="btn btn-dark" name="submit_rating_and_review" type="submit">Submit</button>
								</form>
  							</div>
						</div>
						<!--rate and review end-->
						
						
						<?php
						
							$get_status=$con->query("select status from process_return_or_replace where user_name='".mysqli_real_escape_string($con,$user)."' and order_id='".mysqli_real_escape_string($con,$order_id_detail)."' and unique_type_id='".mysqli_real_escape_string($con,$unique_type_id[$j])."' and quantity='".mysqli_real_escape_string($con,$product_qty[$j])."'");	
						
							$got_status=Array();
							while($get_it=$get_status->fetch_assoc())
								$got_status[]=$get_it['status'];
									    
						?>
						
						
						<?php if($got_status[0]==1) { ?>
								<div class="card-text m-2">Processing 
									<div class="spinner-grow spinner-grow-sm" role="status">
  										<span class="sr-only">Loading...</span>
									</div></div>
							<?php } else if($got_status[0]==2) { ?>
								<h6 class="card-text m-2">Status&nbsp&nbsp<span class="badge badge-success">RETURN Success</span></h6>
							<?php } else if($got_status[0]==3) { ?>
								<h6 class="card-text m-2">Status&nbsp&nbsp<span class="badge badge-success">REPLACE Success</span></h6>
							<?php } else if($got_status[0]==4) { ?>
								<h6 class="card-text m-2">Status&nbsp&nbsp<span class="badge badge-danger">Return or replace not processed</span></h6>
							<?php } else { ?>
								<button class="btn btn-primary btn-sm ml-2 mt-2" style="display:block;" type="button" data-toggle="collapse" data-target="#collapse_r<?=$c?>" aria-expanded="false" aria-controls="collapseExample" <?php if($got_status[0]==1||$got_status[0]==2||$got_status[0]==3||$got_status[0]==4) { ?> disabled <?php } ?> >
									Return or Replace
								</button>
							<?php } ?>
						<!--return or replace-->
						
						
						
						
						<div class="collapse m-2" id="collapse_r<?=$c?>">
  							<div class="card card-body" style="padding:8px;">
								<form method="POST" action="returnorreplace.php" class="input-group d-flex justify-content-center">
									<p>Reason</p>
								<div class="form-group m-2 col-12">
    									<textarea class="form-control" id="reason" rows="3"  cols="100" placeholder="Your reason" name="reason"></textarea>
  								</div>
								
								<div class="form-group m-2 col-12">
									<input type="hidden" name="unique_type_id_rar" value="<?=$unique_type_id[$j]?>" />
									<input type="hidden" name="order_id_rar" value="<?=$order_id_detail?>" />
									<input type="hidden" name="quantity_rar" value="<?=$product_qty[$j]?>" />
  								</div>
								
								<button class="btn btn-dark" name="submit_return_or_replace" type="submit">Submit</button>
								</form>
  							</div>
						</div>
						<!--return or replace end-->
						
						
  					</div>
				</div>
				</div>
			<?php $c++; } ?>
		</div>	
	<?php } ?>
													
          
 <?php include_once '../footer.php'; ?>
