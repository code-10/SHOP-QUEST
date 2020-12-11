<?php
  
  session_start();
  include_once '../libraries/chocolates.php';
  include_once '../header.php';
  $con = getCon();  

  $show=$_GET['show']; 
  $wishdo=$_GET['wishdo'];
  $product_id=$_GET['product_id'];
  $user=$_SESSION['user_name'];
  $product_name=$_GET['product_name'];
  $user=strtolower($user);
  

  
  if(isset($_SESSION['user_name']))
  {
    if($wishdo=="yes"){
      if(($con->query("insert into wishlist(user_name,product_id) values('$user','$product_id');"))===True)
      {
        header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&show=".$show."&&wish=yes");
        die();
      }
     }
    
    
    else if($wishdo=="no")
    {
         $sql="delete from wishlist where user_name='$user' and product_id='$product_id'" ;
   
           if($con->query($sql)===True)
           {    
                  header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&show=".$show."&&wish=no");
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





	//find wishlisted items
	$wishlist_display=$con->query("select * from wishlist where user_name='$user'");
	$product_id_wish=Array();
	while($display=$wishlist_display->fetch_assoc())
	{
		$product_id_wish[]=$display['product_id'];	
	}
	
	$countwish=count($product_id);
	$product_name_wish=Array();

	for($i=0;$i<$n;$i++)
	{
		$product_name_wish[$i]=$con->query("select product_name from products where product_id='$product_id_wish[$i]'")->fetch_assoc('product_name');	
	}

	print_r($product_id_wish);
	print_r($product_name_wish);

    
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


	<div class="row">
		
	</div>
	

<?php include_once '../footer.php';?>
