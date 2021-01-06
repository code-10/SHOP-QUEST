  
<?php
        include_once '../header.php';
        session_start();
        include '../libraries/chocolates.php';

        $con = getCon();  
       
        /*if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	}*/

        
        
        
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

     
        
 <div class="jumbotron">
        <div class="text-center">
              <h4>Return or Replace</h4>
        </div>
    </div>  
	
	
	<a class="btn btn-dark m-4" href="admin_enter.php?admin_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
	
	<?php 
		
		$rar_category=Array();
		$rar_sub_category=Array();
		$rar_product_name=Array();
		$rar_color=Array();
		$rar_size=Array();
		$rar_quantity=Array();
		$rar_rating=Array();
		$rar_product_brand=Array();
		$rar_product_description=Array();
		$rar_price=Array();
		$rar_seller_user_name=Array();
		$rar_unique_type_id=Array();
	
		$rar_process = $con->query("select c.cat_name,sc.sub_cat_name,p.product_name,p.product_brand,p.product_description,p.rating,up.price,up.quantity,up.size,up.color,up.seller_user_name,up.unique_type_id from categories as c,sub_categories as sc,products as p,unique_product as up,process_return_or_replace as pr where pr.unique_type_id=up.unique_type_id and p.product_id=up.product_id and p.sub_cat_id=sc.sub_cat_id and c.cat_id=sc.cat_id");
	
		while($rar_do=$rar_process->fetch_assoc()){
			$rar_category[]=$rar_do[''];
			$rar_sub_category[]=$rar_do[''];
			$rar_product_name[]=$rar_do[''];
			$rar_color[]=$rar_do[''];
			$rar_size[]=$rar_do[''];
			$rar_quantity[]=$rar_do[''];
			$rar_rating[]=$rar_do[''];
			$rar_product_brand[]=$rar_do[''];
			$rar_product_description[]=$rar_do[''];
			$rar_price[]=$rar_do[''];
			$rar_seller_user_name[]=$rar_do[''];
			$rar_unique_type_id[]=$rar_do[''];
		}
		
	
	?>
	
	
	
	
	
	
  
  <?php include_once '../footer.php'; ?>
