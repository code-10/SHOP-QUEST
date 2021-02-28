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
	
	
	
	<div class="text-center m-4">
            <a <?php if($status==0) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=0" role="button">Pending<span class="badge badge-light ml-2"><?=$res0;?></span></a>
	    <a <?php if($status==1) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=1" role="button">Approved<span class="badge badge-light ml-2"><?=$res1;?></span></a>
            <a <?php if($status==2) { ?> class="btn btn-dark m-2" <?php } else { ?> class="btn btn-primary m-2" <?php } ?> href="sell_request.php?sell_request_main=yes&&status=2" role="button">Rejected<span class="badge badge-light ml-2"><?=$res2;?></span></a>
	</div>
	
	
	<?php } ?>
  
  
  
</body>
<?php include_once '../footer.php'; ?>
