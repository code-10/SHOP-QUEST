<?php 
	include_once '../header.php'; session_start(); 
	
	$user=$_SESSION['user_name'];

	if(!(isset($_SESSION['user_name'])))
      {
            header("Location:../index.php");
            die(); 
      } 

	$order_placed=$_GET['order_placed'];
	$your_orders=$_GET['your_orders'];


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

	$count_order=count($order_id);

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
			<div class="col-4 text-center">
				<a href="#" style="color:black;"><?=$order_id[$i]?></a>
			</div>
			<div class="col-4 text-center">
				<a href="#" style="color:black;"><?=$order_date[$i]?></a>
			</div>
			<div class="col-4 text-center">
				<a href="#" style="color:black;"><?=$total_price[$i]?></a>
			</div>
		</div>
		<? } ?>	
	<?php } ?>
          
 <?php include_once '../footer.php'; ?>
