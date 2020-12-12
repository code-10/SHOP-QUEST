<?php 
	include_once '../header.php'; session_start(); 
	include_once '../libraries/chocolates.php';

	$con=getCon();

	$user=$_SESSION['user_name'];
	

	//differentiate and inputs
	$order_id_detail=$_GET['order_id_detail'];
	$order_details=$_GET['order_details'];
	$order_placed=$_GET['order_placed'];
	$your_orders=$_GET['your_orders'];
	$rateandreview=$_GET['rateandreview'];
	$replaceorreturn=$_GET['replaceorreturn'];
	$product_id_rar=$_GET['product_id_rar'];
		

	if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	} 



	//orders
	if($your_orders=="yes")
	{
		$res=$con->query("select * from orders where user_name='$user'");
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
	
		$res2=$con->query("select p.product_name,p.product_id,up.color,up.size,oc.qty,oc.o_rating,oc.review,(oc.qty*up.price) as total_price from products as p,unique_product as up,order_contents as oc,orders as o where oc.order_id=o.order_id and oc.unique_type_id=up.unique_type_id and p.product_id=up.product_id and o.user_name='$user' and oc.order_id='$order_id_detail'");
	
		$product_id=Array();
		$product_name=Array();
		$product_color=Array();
		$product_size=Array();
		$product_qty=Array();
		$product_total_price=Array();
		$product_rating=Array();
		$product_review=Array();

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
		}

		$order_details_count=count($product_id);
		
		
	}





	//rate and review
	/*if($rateandreview=="yes")
	{
		$previous_sum=$con->query("select rating_sum from products where product_id='$product_id_rar'")->fetch_assoc['rating_sum'];
		$new_sum=$previous_sum+
	}*/





	//replace or return
	/*if($replaceorreturn=="yes")
	{
		
	}*/
	
	


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
		<div class="container"><h4 class="text-center m-4 alert alert-success">Your Order is successful, Thank you.</h4></div>
        <?php } else if($your_orders=="yes") { ?>
		<?php for($i=0;$i<$count_orders;$i++) { ?>
		<div class="row m-4 d-flex justify-content-center">
			<div class="col-3 text-center">
				<p style="margin-top=0;margin-bottom:0;"><?=$order_id[$i]?></p>
			</div>
			<div class="col-3 text-center">
				<p style="margin-top=0;margin-bottom:0;"><?=$order_date[$i]?>
			</div>
			<div class="col-3 text-center">
				<p style="margin-top=0;margin-bottom:0;"><?=$total_price[$i]?></p>
			</div>
			<div class="col-3 text-center">
				<a href="successful.php?order_details=yes&&order_id_detail=<?=$order_id[$i]?>"><button class="btn btn-dark">View details</button></a>
			</div>
		</div>
		<? } ?>	
	<?php } else if($order_details=="yes") { ?>
	
		<div class="row m-4 d-flex justify-content-center">
			<?php for($j=0;$j<$order_details_count;$j++) { ?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-12">
					<div class="card m-2">
  					<div class="card-body">
    						<h5 class="card-title">Product name : <?=$product_name[$j]?></h5>
						<p class="card-text">Product color : <?=$product_color[$j]?></p>
						<p class="card-text">Product Specification : <?=$product_size[$j]?></p>
    						<p class="card-text">Quantity : <?=$product_qty[$j]?></p>
						<p class="card-text">Total price : <?=$product_total_price[$j]?></p>
						<p class="card-text">Product rating : <?=$product_rating[$j]?></p>
						<p class="card-text">Product rating : <?=$product_review[$j]?></p>
						
						<a href="#" class="btn btn-primary btn-sm m-2">Rate and review</a>
						
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?=$j?>" aria-expanded="false" aria-controls="collapseExample">
    							Rate and Review
  						</button>
						<div class="collapse" id="collapse<?=$j?>">
  							<div class="card card-body">
								<p>fill</p>
  							</div>
						</div>
						
    						<a href="#" class="btn btn-primary btn-sm m-2">Replace or Return</a>
  					</div>
				</div>
				</div>
			<?php } ?>
		</div>	
	<?php } ?>
													
          
 <?php include_once '../footer.php'; ?>
