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
	
		$cart=$con->query("select c.user_name,p.product_name,up.price,c.qty,up.color,up.size,up.quantity from products as p,cart as c,unique_product as up where p.product_id=up.product_id and c.unique_type_id=up.unique_type_id and user_name='$user'");
		
		$product_name=Array();
		$product_price=Array();
		$product_color=Array();
		$product_size=Array();
		$product_qty=Array();
			
		while($ele=$cart->fetch_assoc())
		{
			$product_name[]=$ele['product_name'];
			$product_price[]=$ele['price'];
			$product_color[]=$ele['color'];
			$product_size[]=$ele['size'];
			$product_qty[]=$ele['qty'];
		}	
	
		$n=count($product_name);
	
	?>
	
	

	<?php for($i=0;$i<$n;$i++) { ?>	
<div class="row">
	<div class="col-lg-4 col-sm-4 col-xs-4 col-md-4 col-6">
		<img src="..." class="figure-img img-fluid rounded mx-auto d-block" style="width:60%;height:50%;" alt="product" onerror="this.src='../assets/black.png';">
	</div>
	</div class="col-lg-8 col-sm-8 col-xs-8 col-md-8 col-6">
		<p><?=$product_name[$i]?></p>
		<p><?=$product_color[$i]?></p>
		<p><?=$product_size[$i]?></p>
		<p><?=$product_qty[$i]?></p>
		<p><?=$product_qty[$i]*$product_price[$i]?></p>
	</div>
</div>
	<?php } ?>
	
	
	



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
      else
      {
            $nolog=true;
            header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&nolog=".$nolog."&&show=".$show);
            die(); 
      } 
?>
   

<?php include_once '../footer.php'; ?>
