<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	} 

	$admin_enter_main=$_GET['admin_enter_main'];
		
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


      
  

	<?php if($admin_enter_main=="yes") { ?>
	
		<div class="text-center m-4">
            <a class="btn btn-primary m-2" href="check_db.php?view=category" role="button">Check DB</a>
			<a class="btn btn-primary m-2" href="enter_data.php" role="button">Enter Data</a>
            <a class="btn btn-primary m-2" href="sell_request.php?sell_request_main=yes&&aprstatus=0" role="button">Check Seller Requests</a>
			<a class="btn btn-primary m-2" href="user_request.php?show_this=1" role="button">Check User Requests</a>
	   </div>
	
	<?php } ?>
	
	
	
	
	
      
      
  
</body>
      
      






<?php include_once '../footer.php'; ?>
