<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      $con=getCon();

      if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	} 


      
      //to get cat_id to fill in add category
      $cat_id_fill=Array();
      $cat_fill=$con->query("select count(*) as c from categories");
      while($cat=$cat_fill->fetch_assoc())
           $cat_id_fill[]=$cat['c'];
      //
        
      //to get sub_cat_id to fill in add category
      $sub_cat_id_fill=Array();
      $sub_cat_fill=$con->query("select count(*) as c from sub_categories");
      while($subcat=$sub_cat_fill->fetch_assoc())
           $sub_cat_id_fill[]=$subcat['c'];
      //


      //to get cat_id to fill in add category
      $cats_id=Array();
      $cats_name=Array();
      $cats_f=$con->query("select * from categories");
      while($catt=$cats_f->fetch_assoc()){
           $cats_id[]=$catt['cat_id'];
           $cats_name[]=$catt['cat_name'];
      }

      $cats=count($cats_id);
      //



	//to get products to fill in add cproducts
      	$pro=$con->query("select * from products");
      //







        if (isset($_POST['categories_submit'])) {
                $cat_id = $_POST['cat_id'];
                $cat_name = $_POST['cat_name'];
                $con = getCon();
              if(($con->query("insert into categories(cat_id,cat_name) values('$cat_id','$cat_name')"))===True){
                //echo "YES";
                header("Location:admin_enter.php?admin_enter_main=yes");
                die();
        }
        else
                echo $con->error;  
        }
           

        if (isset($_POST['sub_categories_submit'])) {
                $con = getCon();
                $sub_cat_id = $_POST['sub_cat_id'];
        $sub_cat_name = $_POST['sub_cat_name'];
        $cat_id = $_POST['cat_id'];
        
        if(($con->query("insert into sub_categories(sub_cat_id,sub_cat_name,cat_id) values('".mysqli_real_escape_string($con,$sub_cat_id)."','".mysqli_real_escape_string($con,$sub_cat_name)."','".mysqli_real_escape_string($con,$cat_id)."')"))===True){
                //echo "YES";
                header("Location:admin_enter.php?admin_enter_main=yes");
                die();
        }
        else
                echo $con->error;
        }


       
        

        if (isset($_POST['products'])) {
                $con = getCon();
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $sub_cat_id = $_POST['sub_cat_id'];
                $product_brand = $_POST['product_brand'];
                $product_description = $_POST['product_description'];
                $product_rating = $_POST['product_rating'];
        
        if(($con->query("insert into products(product_id,product_name,sub_cat_id,product_brand,product_description,rating) values('".mysqli_real_escape_string($con,$product_id)."','".mysqli_real_escape_string($con,$product_name)."','".mysqli_real_escape_string($con,$sub_cat_id)."','".mysqli_real_escape_string($con,$product_brand)."','".mysqli_real_escape_string($con,$product_description)."','".mysqli_real_escape_string($con,$product_rating)."')"))===True){
                //echo "YES";
                header("Location:admin_enter.php?admin_enter_main=yes");
                die();
        }
        else
                echo $con->error;
        }


         if (isset($_POST['uniq_prod'])) {
                $con = getCon();
                $product_id = $_POST['uniq_product_id'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $seller_user_name = $_POST['seller_user_name'];
                $color = $_POST['color'];
                $size = $_POST['size'];
        
        if(($con->query("insert into unique_product(product_id,price,quantity,seller_user_name,color,size) values('".mysqli_real_escape_string($con,$product_id)."','".mysqli_real_escape_string($con,$price)."','".mysqli_real_escape_string($con,$quantity)."','".mysqli_real_escape_string($con,$seller_user_name)."','".mysqli_real_escape_string($con,$color)."','".mysqli_real_escape_string($con,$size)."')"))===True){
                //echo "YES";
                header("Location:admin_enter.php?admin_enter_main=yes");
                die();
        }
        else
                echo $con->error;
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

  
  
  
  
  
 <!--categories-->
      <h5 class="m-4">Add a new category</h5>
    <form class="jumbotron m-4" method="POST" action="enter_data.php">
     <div class="form-group">
        <label for="inputcat_id">category id</label>
        <input type="number" class="form-control" id="inputcat_id" placeholder="categoryid" name="cat_id" value="<?=$cat_id_fill[0]+1?>" disabled>
    </div>
    <div class="form-group">
        <label for="inputcat_name">category name</label>
        <input type="text" class="form-control" id="inputcat_name" placeholder="categoryname" name="cat_name" required>
    </div>
    <button type="submit" name="categories_submit" class="btn btn-dark">Add New Category</button>
    </form>
    
            
                                             
     <!--Sub_categories--> 
      <h5 class="m-4">Add a new sub category</h5>
     <form class="jumbotron m-4" method="POST" action="enter_data.php">
     <div class="form-group">
        <label for="inputsub_cat_id">Sub category id</label>
        <input type="number" min="1" class="form-control" id="inputsub_cat_id" placeholder="subcategoryid" name="sub_cat_id" value="<?=$sub_cat_id_fill[0]+1?>" disabled>
    </div>
    <div class="form-group">
        <label for="inputsub_cat_name">Sub category name</label>
        <input type="text" class="form-control" id="inputsub_cat_name" placeholder="subcategoryname" name="sub_cat_name" required>
    </div>
    <div class="form-group">
	    <label for="cat_name">category name</label>
    		<select class="form-control" id="qty" name="cat_id">
		      <?php for($i=0;$i<$cats;$i++) { ?>
    			<option value="<?=$cats_id[$i]?>"><?=$cats_id[$i]?> - <?=$cats_name[$i]?></option>
                      <?php } ?>
    		</select>
    </div>
    
    <button type="submit" name="sub_categories_submit" class="btn btn-dark">Add New Sub Category</button>
    </form>                                        
                                              
    
    
    
    <!--products-->
	<h5 class="m-4">Add a Product</h5>
    <form class="jumbotron m-4" method="POST" action="enter_data.php">
     <div class="form-group">
        <label for="inputproduct_id">product id</label>
        <input type="number" min="1" class="form-control" id="inputproduct_id" placeholder="product id" name="product_id" value="" disabled>
    </div>
    <div class="form-group">
        <label for="inputsub_cat_id">Sub category id</label>
        <input type="number" min="1" class="form-control" id="inputsub_cat_id" placeholder="subcategoryid" name="sub_cat_id" value="" disabled>
    </div>
    <div class="form-group">
        <label for="input_unique_type_id">Unique type id</label>
        <input type="number" min="1" class="form-control" id="inputunique_type_id" placeholder="unique type id" name="unique_type_id" value="" disabled>
    </div>
    <div class="form-group">
        <label for="inputproduct_name">product name</label>
        <input type="text" class="form-control" id="inputproduct_name" placeholder="product name" name="product_name" required>
    </div>
    <div class="form-group">
        <label for="inputproduct_brand">product brand</label>
        <input type="text" class="form-control" id="inputproduct_brand" placeholder="product brand" name="product_brand" required>
    </div>
    <div class="form-group">
        <label for="inputprice">price</label>
        <input type="number" min="1" class="form-control" id="inputprice" placeholder="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="inputcolor">Color</label>
        <input type="text" class="form-control" id="inputcolor" placeholder="color" name="color" required>
    </div>
    <div class="form-group">
        <label for="inputsize">size</label>
        <input type="text" class="form-control" id="inputsize" placeholder="for mobiles like 4GB i.e ram size else s,m etc" name="size" required>
    </div>
    <div class="form-group">
        <label for="inputquantity">Quantity</label>
        <input type="number" min="1" class="form-control" id="inputquantity" placeholder="quantity" name="quantity"  value="500" required>
    </div>
    
    <div class="form-group">
        <label for="inputseller">Seller User Name</label>
        <input type="text" class="form-control" id="inputseller" placeholder="seller user name" name="seller_user_name"  value="sharma" required>
    </div>    
    <div class="form-group">
        <label for="inputproduct_description">product description</label>
        <textarea type="text" class="form-control" id="inputproduct_description" rows="100" cols="8" placeholder="product description" name="product_description" required></textarea>
    </div>	    
    <button type="submit" name="products" class="btn btn-dark">Add product</button>
    </form>   
    
    
    
 
  
  
  
</body>


<?php include_once '../footer.php'; ?>
