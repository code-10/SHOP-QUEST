<?php
  
  session_start();
  include_once '../libraries/chocolates.php';
  include_once '../header.php';
  $con = getCon();  

  $show=$_GET['show']; 
  $wishdo=$_GET['wishdo'];
  $product_id=$_GET['product_id'];
  $product_id_wish=$_POST['product_id_wish'];
  $user=$_SESSION['user_name'];
  $product_name=$_GET['product_name'];
  $user=strtolower($user);
  $product_description_page=$_GET['product_description_page'];
  

  
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
      else if(isset($_POST['wish_trash']))
      {
	    if(($con->query("delete from wishlist where user_name='$user' and product_id='$product_id_wish'"))===True)
            {
                 header("Location:wishlist.php");
                 die();
            }
            else
            {
                  header("Location:wishlist.php");
                 die();
            }	      
      }
  }
else if($product_description_page=="yes")
{
  $nolog=true;
  header("Location:product_description.php?product_id=".$product_id."&&product_name=".$product_name."&&nolog=".$nolog."&&show=".$show);
        die();
}
else
{
   header("Location: ../index.php");
   die();
}





	//find wishlisted items
	$wishlist_display=$con->query("select * from wishlist where user_name='$user'");
	$product_id_wish=Array();
	while($display=$wishlist_display->fetch_assoc())
	{
		$product_id_wish[]=$display['product_id'];	
	}
	
	$countwish=count($product_id_wish);
	$product_name_wish=Array();

	for($i=0;$i<$countwish;$i++)
    	{
      		$res1 = $con->query("select * from products  where product_id= '$product_id_wish[$i]'");
      		while($ele1 = $res1->fetch_assoc())
      		{ 
        		$product_name_wish[]=$ele1["product_name"];
      		}
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


	
	

	<?php for($i=0;$i<$countwish;$i++) { ?>
		<div class="row m-4 d-flex justify-content-center">
			<div class="col-6 text-right">
				<a href="product_description.php?product_id=<?=$product_id_wish[$i]?>&&product_name=<?=$product_name_wish[$i]?>&&show=0" style="color:black;"><?=$product_name_wish[$i]?></a>
			</div>
			<div class="col-6">
				<form method="POST" action="wishlist.php">
					<input type="hidden" name="product_id_wish" value="<?=$product_id_wish[$i]?>" />
					<button type="submit" class="fa fa-trash btn btn-dark btn-sm pm" name="wish_trash" style="background-color:black;color:white;"></button> 
				</form>
			</div>
		</div>
	<? } ?>
	

<?php include_once '../footer.php';?>
