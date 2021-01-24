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
      $admin_check_sell=$_GET['admin_check_sell'];
      $admin_reject_sell=$_GET['admin_reject_sell'];
	

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
  
  
 <?php
      
	$con=getCon();
      
	
	
	
	
	
	
      //to fill product
      	$product_id_res=$con->query("select count(*) as pc from products");

	$product_id_c=Array();

	while($pic=$product_id_res->fetch_assoc())
		$product_id_c[]=$pic['pc'];

	$product_id_c_use=$product_id_c[0]+1;
		
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
      
      
      
      
      $storeinfoid=$_GET['storeinfoid'];
      $aprstatus=$_GET['aprstatus'];
      //admin reject
      	if($admin_reject_sell=="yes")
	{
		$con->query("update store_info set approved=2 where store_info_id='$storeinfoid'");
		header("Location:sell_request.php?sell_request_main=yes");
                die();
	}
	$admin_update=$_GET['admin_update'];
	$qty=$_GET['qty'];
	//admin_update
	if($admin_update=="yes")
	{	
		$con->query("update store_info set quantity=quantity+'$qty',approved=1 where store_info_id='$storeinfoid'");
		$res=$con->query("select  store_unique_type_id from store_info where store_info_id='$storeinfoid'");
		 $ele = $res->fetch_assoc();
  		$uniq_id=$ele['store_unique_type_id'];
		$con->query("update unique_product set quantity=quantity+'$qty' where unique_type_id='$uniq_id'");
		
		header("Location:sell_request.php?sell_request_main=yes");
                die();
	}
	else if($admin_update=="no")
	{
		$con->query("update store_info set approved=1 where store_info_id='$storeinfoid'");
		header("Location:sell_request.php?sell_request_main=yes");
                die();
	}
	
	
	
      
      
      
      //get info from stpore info
        if($sell_request_main=="yes"){
        $con=getCon();
        $sql="select * from store_info";
    
        $res=$con->query($sql);
  
  $category=array();
  $sub_category=array();
  $product_name=array();
  $product_brand=array();
  $product_description=array();
  $price=array();
  $quantity=array();
  $color=array();
  $size=array();
  $approved=array();
  $storeinfoid=array();
  $seller_name=array();
  
  while($ele = $res->fetch_assoc())
  {
      $category[]=$ele['category'];
      $sub_category[]=$ele['sub_category'];
      $product_name[]=$ele['product_name'];
      $product_brand[]=$ele['product_brand'];
      $product_description[]=$ele['product_description'];
      $price[]=$ele['price'];
      $quantity[]=$ele['quantity'];
      $color[]=$ele['color'];
      $size[]=$ele['size'];
      $approved[]=$ele['approved'];
      $storeinfoid[]=$ele['store_info_id'];
      $seller_name[]=$ele['seller_user_name'];
  }
  
  $n=count($storeinfoid);
    
        }
      
      
      
      
      
      
      
      
      
      
      
      
      if($admin_check_sell=="yes"){
      
      //check by admin
      $storeinfoid=$_GET['storeinfoid'];
        $con=getCon();
        $sql="select * from store_info where store_info_id='$storeinfoid'";
    
        $res=$con->query($sql);
  
  $category=array();
  $subcategory=array();
  $product_name=array();
  $product_brand=array();
  $product_description=array();
  $price=array();
  $quantity=array();
  $color=array();
  $size=array();
  $approved=array();
  $storeinfoid=array();
  $seller_name=array();
  
  while($ele = $res->fetch_assoc())
  {
      $category[]=$ele['category'];
      $subcategory[]=$ele['sub_category'];
      $product_name[]=$ele['product_name'];
      $product_brand[]=$ele['product_brand'];
      $product_description[]=$ele['product_description'];
      $price[]=$ele['price'];
      $quantity[]=$ele['quantity'];
      $color[]=$ele['color'];
      $size[]=$ele['size'];
      $approved[]=$ele['approved'];
      $storeinfoid[]=$ele['store_info_id'];
      $seller_name[]=$ele['seller_user_name'];
  }
  
  $n=count($storeinfoid);
      
      }
      
      
      
      
      
      
      if(isset($_POST['verify_product']))
      {
            $con=getCon();

  
      $subcategoryid=$_POST['sub_cat_id'];
      $productid=$_POST['product_id'];
      $productname=$_POST['product_name'];
      $productbrand=$_POST['product_brand'];
      $productdescription=$_POST['product_description'];
      $price=$_POST['price'];
      $quantity=$_POST['qty'];
      $color=$_POST['color'];
      $size=$_POST['size'];
      $sellername=$_POST['seller_name'];
      $rating=$_POST['rating'];          

     
  
      //For Store info
      $approved=$_POST['approve'];
      $storeinfoid=$_POST['storeinfoid'];
      $store_info_id=$_POST['store_info_id'];
      //$done=1;      

	$user=$_SESSION['user_name'];
      //for updating store info
      $sql1="update store_info set approved=1 where store_info_id='$storeinfoid'";
      $sql2="insert into products(product_id,product_name,sub_cat_id,product_brand,product_description,rating) values('".mysqli_real_escape_string($con,$product_id_c_use)."','".mysqli_real_escape_string($con,$productname)."','".mysqli_real_escape_string($con,$subcategoryid)."','".mysqli_real_escape_string($con,$productbrand)."','".mysqli_real_escape_string($con,$productdescription)."','".mysqli_real_escape_string($con,$rating)."')";
      $sql3="insert into unique_product(product_id,price,quantity,seller_user_name,color,size) values('".mysqli_real_escape_string($con,$product_id_c_use)."','".mysqli_real_escape_string($con,$price)."','".mysqli_real_escape_string($con,$quantity)."','".mysqli_real_escape_string($con,$sellername)."','".mysqli_real_escape_string($con,$color)."','".mysqli_real_escape_string($con,$size)."')";
      
 	$sql4="update store_info set store_product_id='".mysqli_real_escape_string($con,$product_id_c_use)."',admin_sub_category='".mysqli_real_escape_string($con,$subcategoryid)."',admin_product_name='".mysqli_real_escape_string($con,$productname)."',admin_product_brand='".mysqli_real_escape_string($con,$productbrand)."',admin_product_description='".mysqli_real_escape_string($con,$productdescription)."',admin_price='".mysqli_real_escape_string($con,$price)."',admin_quantity='".mysqli_real_escape_string($con,$quantity)."',admin_color='".mysqli_real_escape_string($con,$color)."',admin_size='".mysqli_real_escape_string($con,$size)."'";  
	    
	$sql5="update store_info set store_unique_type_id = (select unique_type_id from unique_product where product_id='$product_id_c_use' and seller_user_name='$sellername') where store_info_id='$storeinfoid'";
	
	      
      if($con->query($sql2)===True)
      {
        if($con->query($sql3)===True)
        {
          if($con->query($sql1)===True)
          {
	   	if($con->query($sql4)===True)
		{	
			if($con->query($sql5)===True)
			{
              			header("Location:sell_request.php?sell_request_main=yes");
                		die();
			}
		}
          }
        }
      }
      else
      {
        echo "something went wrong"; 
      }  
            
      }
      
    
    
    ?>
    
  <!--Enter data into categories-->
    <div class="jumbotron">
        <div class="text-center">
              <h4>Seller requests</h4>
        </div>
    </div>
     
	<a class="btn btn-dark ml-4" href="admin_enter.php?admin_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
	
	<div class="text-center m-4">
            <a class="btn btn-primary m-2" href="sell_request.php?sell_request_main=yes&&aprstatus=0" role="button">Pending</a>
	    <a class="btn btn-primary m-2" href="sell_request.php?sell_request_main=yes&&aprstatus=1" role="button">Approved</a>
            <a class="btn btn-primary m-2" href="sell_request.php?sell_request_main=yes&&aprstatus=2" role="button">Rejected</a>
	</div>
	
	
      <?php if($sell_request_main=="yes") { ?>
      
	<? for($i=0;$i<$n;$i++) { ?>
	
	<? if($aprstatus!=$approved[$i]&&!($aprstatus==0 && $approved[$i]>2)) 
		 continue; ?>
<div class="card m-4">
  <div class="card-header">seller name : <?=$seller_name[$i]?></div>
  <div class="card-body">
    <p class="card-text">Product name : <?=$product_name[$i]?></p>
    <p class="card-text">category : <?=$category[$i]?></p>
    <p class="card-text">sub category : <?=$sub_category[$i]?></p>
    <p class="card-text">product brand  : <?=$product_brand[$i]?></p>
    <p class="card-text">product description : <?=$product_description[$i]?></p>
    <p class="card-text">price : <?=$price[$i]?></p>
    <p class="card-text">color : <?=$color[$i]?></p>
    <p class="card-text">size  : <?=$size[$i]?></p>
    <p class="card-text">quantity : <?=$quantity[$i]?></p>
    
    <? if($approved[$i]==1) { ?>
    	<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-success">Success</span></h6>
	
    <? } else if($approved[$i]==2) { ?>
	 <h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-danger">Rejected</span></h6> 
    <? } else if($approved[$i]==0){ ?>
    	<h6 class="card-text">Status&nbsp&nbsp - waiting for approval<div class="spinner-grow spinner-grow-sm" role="status"></div></h6>
    	<a href='sell_request.php?admin_check_sell=yes&&storeinfoid=<?=$storeinfoid[$i]?>' class="btn btn-success m-2">Edit and Approve</a>
    	<a href='sell_request.php?admin_reject_sell=yes&&storeinfoid=<?=$storeinfoid[$i]?>' name="reject_application" class="btn btn-danger m-2">Reject</a>
    <? } else { ?>
	  <p class="card-text">new quantity : <?=$approved[$i]?></p>
	  <h6 class="card-text">Status&nbsp&nbsp - waiting for approval<div class="spinner-grow spinner-grow-sm" role="status"></div></h6>
    	<a href='sell_request.php?admin_update=yes&&storeinfoid=<?=$storeinfoid[$i]?>&&qty=<?=$approved[$i]?>' class="btn btn-success m-2">Update</a>
    	<a href='sell_request.php?admin_update=no&&storeinfoid=<?=$storeinfoid[$i]?>' class="btn btn-danger m-2">Don't Update</a>
    <? } ?>
</div>
</div> 
		
  <? } ?>   
  
  <?php } else if($admin_check_sell=="yes") { ?>
      
       <form class="jumbotron m-4" method="POST" action="sell_request.php">
         <!--seller name-->
     <div class="form-group">
        <label for="inputsellername">Seller name</label>
        <input type="text" class="form-control" id="inputsellername" placeholder="" value="<?=$seller_name[0]?>" name="seller_name" required>
    </div>
         <!--sub cat id-->
     <div class="form-group">
	    <label for="cat_name">category and sub category name</label>
    		<select class="form-control" id="qty" name="sub_cat_id">
		      <?php for($i=0;$i<$cats;$i++) { ?>
    			<option value="<?=$sub_cats_id[$i]?>"><?=$cats_name[$i]?> - <?=$sub_cats_name[$i]?></option>
                      <?php } ?>
    		</select>
    </div> 
         <!--product id-->
     <div class="form-group">
        <label for="inputproduct_id">product id</label>
        <input type="number" class="form-control" id="inputproduct_id" placeholder="product id" name="product_id" value="<?=$product_id_c_use?>" disabled>
    </div>
         <!--product name-->
    <div class="form-group">
        <label for="inputproduct_name">product name</label>
        <input type="text" class="form-control" id="inputproduct_name" placeholder="" value="<?=$product_name[0]?>" name="product_name" required>
    </div>
         <!--product brand-->
    <div class="form-group">
        <label for="inputbrand">product brand</label>
        <input type="text" class="form-control" id="inputbrand" placeholder="" value="<?=$product_brand[0]?>" name="product_brand" required>
    </div>     
         <!--product description-->
     <div class="form-group">
        <label for="inputdesc">product Description</label>
        <input type="text" class="form-control" id="inputdesc" placeholder="" value="<?=$product_description[0]?>" name="product_description" required>
    </div>    
         <!--product rating-->
     <div class="form-group">
        <label for="inputrating">product rating</label>
        <input type="number" class="form-control" id="inputrating" placeholder="rating" name="rating" value="0" disabled>
    </div>     
         <!--price-->
    <div class="form-group">
        <label for="inputprice">price</label>
        <input type="number" class="form-control" id="inputprice" placeholder="" value="<?=$price[0]?>" name="price" required>
    </div>     
         <!--size-->
    <div class="form-group">
        <label for="inputsize">size</label>
        <input type="text" class="form-control" id="inputsize" placeholder="" value="<?=$size[0]?>" name="size" required>
    </div>
         <!--color-->
    <div class="form-group">
        <label for="inputcolor">color</label>
        <input type="text" class="form-control" id="inputcolor" placeholder="" value="<?=$color[0]?>" name="color" required>
    </div>
         <!--quantity-->
    <div class="form-group">
        <label for="inputqty">quantity</label>
        <input type="number" class="form-control" id="inputqty" placeholder="" value="<?=$quantity[0]?>" name="qty" required> 
    </div>
         <!--storeinfoid-->
    <div class="form-group">
        <label for="inputstoreinfoid">store info id</label>
        <input type="number" class="form-control" id="inputstoreinfoid" placeholder="" value="<?=$storeinfoid[0]?>" name="storeinfoid" required> 
    </div>
         <!--approve status-->
    <div class="form-group">
        <label for="inputapprove">approve status - [1/0]</label>
        <input type="number" class="form-control" id="inputapprove" placeholder="" value="1" name="approve" required> 
    </div>     
	       
    <input type="hidden" name="store_info_id" value="<?=$storeinfoid[0]?>" />	       
	       
    <button type="submit" name="verify_product" class="btn btn-dark">Approve</button>
    </form>     
      
      <?php } ?>
            
  
  
  
  
  
  
</body>
<?php include_once '../footer.php'; ?>
