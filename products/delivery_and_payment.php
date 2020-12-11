<?php

      include_once '../header.php';
      include_once '../libraries/chocolates.php';
      session_start();

      $con=getCon();
      
      $user=$_SESSION['user_name'];

	
      if(isset($_POST['done']))
      {
		      
      }

      if(!(isset($_SESSION['user_name'])))
      {
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
	
	

<?php for($i=0;$i<$n;$i++) { ?>	
	<div class="row m-4 d-flex justify-content-end">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><?=$product_name[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><?=$product_color[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><?=$product_size[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><p><?=$product_qty[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$product_qty[$i]*$product_price[$i]?></p></div>
	</div>

<?php } ?>	

        <div class="row m-4 d-flex justify-content-end">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><p>Total Price </p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$total_price?></p></div>
	</div>	
	
<div class="m-4 d-flex justify-content-center">
	<form method="POST" action="delivery_and_payment.php">
	<div class="col">
  			<div class="form-group">
    				<label for="exampleFormControlTextarea1">Enter your Address</label>
    				<textarea class="form-control" name="address" rows="8" cols="48"></textarea>
  			</div>
	</div>
	<div class="col">
  			<div class="form-group">
    				<label for="exampleFormControlTextarea1">Enter total price</label>
				<input type="number" class="form-control"  name="price" placeholder="Just enter the total price">
  			</div>
	</div>
</div>
	
	
		    <div class="container">
			    <button type="submit" class="btn btn-dark btn-block mb-4" name="done">Pay and Place your order</button>
		    </div>

	</form>
	
          
 <?php include_once '../footer.php';
