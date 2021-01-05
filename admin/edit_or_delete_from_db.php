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
		$p_edit_sub_cat_id=Array();
		$p_edit_product_id=Array();
		$p_edit_product_name=Array();
		$p_edit_product_brand=Array();
		$p_edit_product_description=Array();
		$p_edit_product_rating=Array();
		
		$p_edit_product=$con->query("select * from products where product_id='$edit_delete_product_id'");
		
		while($ans=$p_edit_product->fetch_assoc())
		{
			$p_edit_sub_cat_id[]=$ans['sub_cat_id'];
			$p_edit_product_id[]=$ans['product_id'];
			$p_edit_product_name[]=$ans['product_name'];
			$p_edit_product_brand[]=$ans['product_brand'];
			$p_edit_product_description[]=$ans['product_description'];
			$p_edit_product_rating[]=$ans['rating'];
		}
		
		
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
              <h4>Edit or Delete Database Details</h4>
        </div>
    </div>       
   
        
	<?php if(isset($_POST['edit_info_p'])) { ?>
	
	<h5 class="m-4">Edit Product</h5>
    <form class="jumbotron m-4" method="POST" action="edit_or_delete_from_db.php">
     <div class="form-group">
        <label for="inputsub_cat_id">Sub category id</label>
        <input type="number" min="1" class="form-control" id="inputsub_cat_id" placeholder="subcategoryid" name="sub_cat_id" value="<?=$p_edit_sub_cat_id[0]?>" disabled>
    </div>
     <div class="form-group">
        <label for="inputproduct_id">product id</label>
        <input type="number" class="form-control" id="inputproduct_id" placeholder="product id" name="product_id" value="<?=$p_edit_product_id[0]?>" disabled>
    </div>
    <div class="form-group">
        <label for="inputproduct_name">product name</label>
        <input type="text" class="form-control" id="inputproduct_name" placeholder="product name" name="product_name" value="<?=$p_edit_product_name[0]?>" required>
    </div>
    <div class="form-group">
        <label for="inputproduct_brand">product brand</label>
        <input type="text" class="form-control" id="inputproduct_brand" placeholder="product brand" name="product_brand" value="<?=$p_edit_product_brand[0]?>" required>
    </div>
    <div class="form-group">
        <label for="inputproduct_description">product description</label>
        <textarea type="text" class="form-control" id="inputproduct_description" rows="8" cols="4" placeholder="product description" name="product_description" value="<?=echo $p_edit_product_description[0]?>" required></textarea>
    </div>
    <div class="form-group">
        <label for="inputproduct_rating">product rating</label>
        <input type="number" class="form-control" id="inputproduct_rating" placeholder="product rating" name="product_rating" value="<?=$p_edit_product_rating[0]?>" required>
    </div>
    <button type="submit" name="edit_product" class="btn btn-dark">Edit product</button>
    </form> 	

<?php } else if(isset($_POST['edit_info_u'])) { ?>
	
	<!--products-->
	<h5 class="m-4">Edit a Unique Product</h5>
    <form class="jumbotron m-4" method="POST" action="edit_or_delete_from_db.php">
     <div class="form-group">
        <label for="inputproduct_id">product id</label>
        <input type="number" class="form-control" id="inputproduct_id" placeholder="product id" name="product_id" value="fill" disabled>
    </div>
    <div class="form-group">
        <label for="inputunique_type_id">Unique type id</label>
        <input type="number" class="form-control" id="inputunique_type" placeholder="unique_type_id" name="unique_type" value="fill" disabled>
    </div>
    <div class="form-group">
        <label for="inputproduct_name">product name</label>
        <input type="text" class="form-control" id="inputproduct_name" placeholder="product name" name="product_name" value="fill" required>
    </div>
    <div class="form-group">
        <label for="inputproduct_brand">product brand</label>
        <input type="text" class="form-control" id="inputproduct_brand" placeholder="product brand" name="product_brand" value="fill" required>
    </div>
    <div class="form-group">
        <label for="inputprice">price</label>
        <input type="number" min="1" class="form-control" id="inputprice" placeholder="price" name="price" value="fill" required>
    </div>
    <div class="form-group">
        <label for="inputcolor">Color</label>
        <input type="text" class="form-control" id="inputcolor" placeholder="color" name="color" value="fill" required>
    </div>
    <div class="form-group">
        <label for="inputsize">size</label>
        <input type="text" class="form-control" id="inputsize" placeholder="for mobiles like 4GB i.e ram size else s,m etc" name="size" value="fill" required>
    </div>
    <div class="form-group">
        <label for="inputproduct_description">product description</label>
        <textarea type="text" class="form-control" id="inputproduct_description" rows="8" cols="4" placeholder="product description" name="product_description" value="fill" required></textarea>
    </div>
    <div class="form-group">
        <label for="inputquantity">Quantity</label>
        <input type="number" min="1" max="420" class="form-control" id="inputquantity" placeholder="quantity" name="quantity" value="fill" required>
    </div>   
    <div class="form-group">
        <label for="inputseller">Seller User Name</label>
        <input type="text" class="form-control" id="inputseller" placeholder="seller user name" name="seller_user_name" value="fill" required>
    </div> 
    <div class="form-group">
        <label for="inputproduct_rating">product rating</label>
        <input type="number" class="form-control" id="inputproduct_rating" placeholder="product rating" name="product_rating" value="fill" disabled>
    </div>
    <button type="submit" name="products" class="btn btn-dark">Add product</button>
    </form> 
	
<?php } ?>
	
        
  
  
  
</body>

<?php include_once '../footer.php'; ?>
