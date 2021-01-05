<?php
        include_once '../header.php';
        session_start();
        include '../libraries/chocolates.php';
        $category=Array();
        $con = getCon();  
       
        /*if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	} */


        
        
        
?>

<?php

	$edit_delete_product_id=$_POST['edit_delete_product_id'];
	$edit_delete_unique_type_id=$_POST['edit_delete_unique_type_id'];

	if(isset($_POST['edit_info_p']))
	{
		
	}
	else if(isset($_POST['edit_info_u']))
	{
		
	}
	else if(isset($_POST['delete_info_p']))
	{
		$con->query("delete from unique_product where product_id='$edit_delete_product_id'");
		$con->query("delete from products where product_id='$edit_delete_product_id'");
                header("Location:check_db.php");
	}
	else if(isset($_POST['delete_info_u']))
	{
		$con->query("delete from unique_product where unique_type_id='$edit_delete_unique_type_id'");
                header("Location:check_db.php");
	}

?>



<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">ShopShop</a>
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

     
        
 <div class="jumbotron">
        <div class="text-center">
              <h4>Edit or Delete Database Details</h4>
        </div>
    </div>       
   
        
        
  
  
  
</body>

<?php include_once '../footer.php'; ?>
