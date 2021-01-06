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
	$cat_id_fill_use=$cat_id_fill[0]+1;
      //
        
      //to get sub_cat_id to fill in add category
      $sub_cat_id_fill=Array();
      $sub_cat_fill=$con->query("select count(*) as c from sub_categories");
      while($subcat=$sub_cat_fill->fetch_assoc())
           $sub_cat_id_fill[]=$subcat['c'];
	$sub_cat_id_fill_use=$sub_cat_id_fill[0]+1;
      //



      //to get cat_id to fill in add category
      $catss_id=Array();
      $catss_name=Array();
      $catss_f=$con->query("select * from categories");
      while($catts=$catss_f->fetch_assoc()){
           $catss_id[]=$catts['cat_id'];
           $catss_name[]=$catts['cat_name'];
      }

      $catsc=count($catss_id);
      //



      //to get cat_id to fill in add category and subcategory
      $cats_id=Array();
      $cats_name=Array();
      $sub_cats_id=Array();
      $sub_cats_name=Array();
      $cats_f=$con->query("select s.cat_id,s.cat_name,sc.sub_cat_id,sc.sub_cat_name from categories as s,sub_categories as sc where sc.cat_id=s.cat_id");
      while($catt=$cats_f->fetch_assoc()){
           $cats_id[]=$catt['cat_id'];
           $cats_name[]=$catt['cat_name'];
	   $sub_cats_id[]=$catt['sub_cat_id'];
           $sub_cats_name[]=$catt['sub_cat_name'];
      }

      $cats=count($cats_id);
      //


	//to fill product
      	$product_id_res=$con->query("select count(*) as pc from products");

	$product_id_c=Array();

	while($pic=$product_id_res->fetch_assoc())
		$product_id_c[]=$pic['pc'];

	$product_id_c_use=$product_id_c[0]+1;
		
      //







        if (isset($_POST['categories_submit'])) {
		$con = getCon();
                $cat_id = $_POST['cat_id'];
                $cat_name = $_POST['cat_name'];
		
              if(($con->query("insert into categories(cat_id,cat_name) values('$cat_id_fill_use','$cat_name')"))===True){
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
        
        if(($con->query("insert into sub_categories(sub_cat_id,sub_cat_name,cat_id) values('".mysqli_real_escape_string($con,$sub_cat_id_fill_use)."','".mysqli_real_escape_string($con,$sub_cat_name)."','".mysqli_real_escape_string($con,$cat_id)."')"))===True){
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
                $sub_cat_id = $_POST['sub_cat_id'];
                $product_name = $_POST['product_name'];
                $product_brand = $_POST['product_brand'];
		$price = $_POST['price'];
		$color = $_POST['color'];
                $size = $_POST['size'];
		$product_description = $_POST['product_description'];
                $quantity = $_POST['quantity'];
                $seller_user_name = $_POST['seller_user_name'];
                
        
        	if(($con->query("insert into products(product_id,product_name,sub_cat_id,product_brand,product_description,rating,rating_no,rating_sum) values('".mysqli_real_escape_string($con,$product_id_c_use)."','".mysqli_real_escape_string($con,$product_name)."','".mysqli_real_escape_string($con,$sub_cat_id)."','".mysqli_real_escape_string($con,$product_brand)."','".mysqli_real_escape_string($con,$product_description)."','".mysqli_real_escape_string($con,$product_rating)."',0,0)"))===True){
                	if(($con->query("insert into unique_product(product_id,price,quantity,seller_user_name,color,size) values('".mysqli_real_escape_string($con,$product_id_c_use)."','".mysqli_real_escape_string($con,$price)."','".mysqli_real_escape_string($con,$quantity)."','".mysqli_real_escape_string($con,$seller_user_name)."','".mysqli_real_escape_string($con,$color)."','".mysqli_real_escape_string($con,$size)."')"))===True){
                		//echo "YES";
                		header("Location:admin_enter.php?admin_enter_main=yes");
                		die();
        		}
			else
                		echo $con->error;
		}
       		else
                	echo $con->error;

        	
  
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
              <h4>Enter Data</h4>
        </div>
    </div>
	
<a class="btn btn-dark ml-4" href="admin_enter.php?admin_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
  
  
 <!--categories-->
      <h5 class="m-4">Add a new category</h5>
    <form class="jumbotron m-4" method="POST" action="enter_data.php">
     <div class="form-group">
        <label for="inputcat_id">category id</label>
        <input type="number" class="form-control" id="inputcat_id" placeholder="categoryid" name="cat_id" value="<?=$cat_id_fill_use?>" disabled>
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
        <input type="number" min="1" class="form-control" id="inputsub_cat_id" placeholder="subcategoryid" name="sub_cat_id" value="<?=$sub_cat_id_fill_use?>" disabled>
    </div>
    <div class="form-group">
        <label for="inputsub_cat_name">Sub category name</label>
        <input type="text" class="form-control" id="inputsub_cat_name" placeholder="subcategoryname" name="sub_cat_name" required>
    </div>
    <div class="form-group">
	    <label for="cat_name">category name</label>
    		<select class="form-control" id="qty" name="cat_id">
		      <?php for($j=0;$j<$catsc;$j++) { ?>
    			<option value="<?=$catss_id[$j]?>"><?=$catss_name[$j]?></option>
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
        <input type="number" class="form-control" id="inputproduct_id" placeholder="product id" name="product_id" value="<?=$product_id_c_use?>" disabled>
    </div>
    <div class="form-group">
	    <label for="cat_name">category and sub category name</label>
    		<select class="form-control" id="qty" name="sub_cat_id">
		      <?php for($i=0;$i<$cats;$i++) { ?>
    			<option value="<?=$sub_cats_id[$i]?>"><?=$cats_name[$i]?> - <?=$sub_cats_name[$i]?></option>
                      <?php } ?>
    		</select>
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
        <label for="inputproduct_description">product description</label>
        <textarea type="text" class="form-control" id="inputproduct_description" rows="8" cols="4" placeholder="product description" name="product_description" required></textarea>
    </div>
    <div class="form-group">
        <label for="inputquantity">Quantity</label>
        <input type="number" min="1" max="420" class="form-control" id="inputquantity" placeholder="quantity" name="quantity" required>
    </div>   
    <div class="form-group">
        <label for="inputseller">Seller User Name</label>
        <input type="text" class="form-control" id="inputseller" placeholder="seller user name" name="seller_user_name" required>
    </div> 
    <div class="form-group">
        <label for="inputproduct_rating">product rating</label>
        <input type="number" class="form-control" id="inputproduct_rating" placeholder="product rating" name="product_rating" value="0" disabled>
    </div>
    <button type="submit" name="products" class="btn btn-dark">Add product</button>
    </form>   
    
    
    
 
  
  
  
</body>


<?php include_once '../footer.php'; ?>
