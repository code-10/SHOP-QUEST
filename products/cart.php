<?php

      include_once '../header.php';
      include_once '../libraries/chocolates.php';
      session_start();

      $con=getCon();

      $user=$_SESSION['user_name'];
      $show=$_POST['show'];
      $unique_type_id=$_POST['unique_type_id'];
      $product_id=$_POST['product_id'];
      $product_name=$_POST['product_name'];
      $quantity=$_POST['quantity'];
      $product_description_cart=$_POST['product_description_cart']; 

?>




<?php
      if(isset($_SESSION['user_name']))
      {
      if(isset($_POST['addtocart']))
      {
            if(($con->query("insert into cart(user_name,unique_type_id,qty) values('$user','$unique_type_id','$quantity');"))===True)
            {
                header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&addtocart=yes&&show=".$show);
                die();
            }
            else
            {
                  header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&addtocart=yes&&show=".$show);
                  die();
            }
      }
      else if(isset($_POST['buy']))
      {
            if(($con->query("insert into cart(user_name,unique_type_id,qty) values('$user','$unique_type_id','$quantity');"))===True)
            {
                 header("Location:cart.php");
                 die();
            }
            else
            {
                  header("Location:cart.php");
                 die();
            }
      
      } 
      }
      else if($product_description_cart)
      {
  		$nolog=true;
  		header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&nolog=".$nolog."&&show=".$show);
        	die();
      }
	      
	
	


	



      if(isset($_SESSION['user_name']))
      {
      if(isset($_POST['trash']))
      {
	    if(($con->query("delete from cart where user_name='$user' and unique_type_id='$unique_type_id'"))===True)
            {
                 header("Location:cart.php");
                 die();
            }
            else
            {
                  header("Location:cart.php");
                 die();
            }	     
      }
      else if(isset($_POST['minus']))
      {
	      $qty_in_cart=$con->query("select qty from cart where unique_type_id='$unique_type_id' and user_name='$user'")->fetch_assoc()['qty']; 
	      $qty_to_cart=$qty_in_cart-1;
	      
	    if($qty_in_cart==1)
	    {
		   if(($con->query("delete from cart where user_name='$user' and unique_type_id='$unique_type_id'"))===True)
                   {
                         header("Location:cart.php");
                         die();
                   }
                   else
                   {
                         header("Location:cart.php");
                         die();
                   }  
	    }
	    else{
	    	if(($con->query("update cart set qty='$qty_to_cart' where user_name='$user' and unique_type_id='$unique_type_id'"))===True)
            	{
                 	header("Location:cart.php");
                	 die();
            	}
           	 else
            	{
                 	header("Location:cart.php");
                 	die();
            	}
	    }
      }
      else if(isset($_POST['plus']))
      {
           $remaining_quantity=$con->query("select quantity from unique_product where unique_type_id='$unique_type_id'")->fetch_assoc()['quantity']; 
	   $remaining_quantity=min(3,$remaining_quantity);
	   $qty_in_cart=$con->query("select qty from cart where unique_type_id='$unique_type_id' and user_name='$user'")->fetch_assoc()['qty']; 
	   $qty_to_cart=$qty_in_cart+1;   
	      
	   if($qty_in_cart<=$remaining_quantity)
	   {
		if(($con->query("update cart set qty='$qty_to_cart' where user_name='$user' and unique_type_id='$unique_type_id'"))===True)
            	{
                 	header("Location:cart.php");
                	 die();
            	}
           	 else
            	{
                 	header("Location:cart.php");
                 	die();
            	}	   
	   }
	   else
	   {
		 header("Location:cart.php");
                 die();
	   }
	   
      }
      	     
      }
      else
      {
            $nolog=true;
            header("Location:../index.php");
            die();
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
	
	
	<?php
	
		$cart=$con->query("select c.user_name,p.product_name,up.unique_type_id,up.price,c.qty,up.color,up.size,up.quantity from products as p,cart as c,unique_product as up where p.product_id=up.product_id and c.unique_type_id=up.unique_type_id and user_name='$user'");
		
		$product_name=Array();
		$product_price=Array();
		$product_color=Array();
		$product_size=Array();
		$product_qty=Array();
		$unique_type_id=Array();
			
		while($ele=$cart->fetch_assoc())
		{
			$product_name[]=$ele['product_name'];
			$product_price[]=$ele['price'];
			$product_color[]=$ele['color'];
			$product_size[]=$ele['size'];
			$product_qty[]=$ele['qty'];
			$unique_type_id[]=$ele['unique_type_id'];
		}	
	
		$n=count($product_name);
	
		$total_price=0;
		for($i=0;$i<$n;$i++)
		{
			$total_price=$total_price+($product_qty[$i]*$product_price[$i]);
		}
	
	?>
	
	

<?php if($n>0) { for($i=0;$i<$n;$i++) { ?>	
	<div class="row m-4 d-flex justify-content-center">
		<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-6">
			<img src="..." class="figure-img img-fluid rounded float-right pro" alt="product" onerror="this.src='../assets/black.png';">
		</div>
		<div class="col-lg-10 col-sm-10 col-xs-10 col-md-10 col-6">
			<div class="row">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"><?=$product_name[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"><?=$product_color[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"><?=$product_size[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;">
				<form method="POST" action="cart.php">
					<input type="hidden" name="unique_type_id" value="<?=$unique_type_id[$i]?>" />
					<button type="submit" class="fa fa-minus btn btn-dark btn-sm pm" name="minus" style="background-color:black;color:white;"></button>&nbsp&nbsp<?=$product_qty[$i]?>&nbsp&nbsp<button type="submit" class="fa fa-plus btn btn-dark btn-sm pm" name="plus" style="background-color:black;color:white;"></button>
				</form>
				</div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$product_qty[$i]*$product_price[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8">
				<form method="POST" action="cart.php">
					<input type="hidden" name="unique_type_id" value="<?=$unique_type_id[$i]?>" />
					<button type="submit" class="fa fa-trash btn btn-dark btn-sm pm" name="trash" style="background-color:black;color:white;"></button> 
				</form>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
	
		
<div class="row m-4 d-flex justify-content-center">
		<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-6">
		</div>
		<div class="col-lg-10 col-sm-10 col-xs-10 col-md-10 col-6">
			<div class="row">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><p style="margin-bottom:0px;"><h5>Total Price </h5></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"><h5 style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$total_price?></h5></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-8"></div>
			</div>
		</div>
	</div>	
	
	       
	       <!--continue-->
		    <div class="container">
		    		<a href="order.php" class="btn btn-dark btn-block mb-4" type="submit" name="buy">Continue</a>
		    </div>		
		
	    <?php } else { ?>
	<div class="text-center m-4">
		<h5>Nothing in your cart yet</h5>
	</div>
	<div class="container d-flex justify-content-center">
				    <a href="../index.php" class="btn btn-dark mb-4">Let me shop</a>
			   
		    </div>
<?php } ?>
	

		

	
	
	

	
<style>
    /*Media Queries*/
	@media (min-width:320px)  { .pro{width:100%;height:100%;} .pm{font-size:10px;}  /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .pro{width:32%;height:88%;} .pm{font-size:20px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .pro{width:32%;height:88%;} .pm{font-size:20px;} /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .pro{width:32%;height:88%;} .pm{font-size:20px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .pro{width:32%;height:88%;} .pm{font-size:20px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .pro{width:32%;height:88%;} .pm{font-size:20px;}  /* hi-res laptops and desktops */ }
	
</style>
   

<?php include_once '../footer.php'; ?>
