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
	
	?>
	
	
	<div class="text-center m-4">
            <a <?php if($status==0) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=0" role="button">Pending<span class="badge badge-light ml-2"><?=$res0;?></span></a>
	    <a <?php if($status==1) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=1&&stock_variant=yes" role="button">Approved<span class="badge badge-light ml-2"><?=$res1;?></span></a>
            <a <?php if($status==2) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=2" role="button">Rejected<span class="badge badge-light ml-2"><?=$res2;?></span></a>
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
			
			echo "under contruction";
	
		<?php } ?>
	
	
	
	<?php } ?>
  
  
  
</body>
<?php include_once '../footer.php'; ?>
