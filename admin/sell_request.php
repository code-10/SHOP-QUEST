<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	} 

      $sell_request_main=$_GET['sell_request_main'];
      $admin_check_sell=$_GET['admin_check_sell'];
      $approve_sell=$_GET['approve_sell'];

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
  
  
 <?php
      
      //get info from stpore info
        
        $con=getCon();
        $sql="select * from store_info";
    
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
      
      
      
      
    
    
    ?>
    
  <!--Enter data into categories-->
    <div class="jumbotron">
        <div class="text-center">
              <h4>Seller requests</h4>
        </div>
    </div>
     
      
      <?php if($sell_request_main=="yes") { ?>
      
      <? for($i=0;$i<$n;$i++) { ?>
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
    
    <? if($approved[$i]) { ?>
    <h6 class="card-text">Approved&nbsp&nbsp<span class="badge badge-success">Success</span></h6>
    
    <? } else { ?>
    <h6 class="card-text">waiting for Approval&nbsp&nbsp<div class="spinner-grow spinner-grow-sm" role="status"></div></h6>
    <? } ?>
    
    <a href='sell_request.php?admin_check_sell=yes&&storeinfoid=<?=$storeinfoid[$i]?>' class="btn btn-primary m-2">Edit to Approve</a>
    <a href="#" name="delete_info" class="btn btn-primary m-2">delete</a>
    <a href="#" name="archive_info" class="btn btn-primary m-2">Archive</a>

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
        <label for="inputsubcat">Sub category id - (fill it)</label>
        <input type="number" class="form-control" id="inputsubcat" placeholder="" name="subcatid" required>
    </div>
         <!--product id-->
     <div class="form-group">
        <label for="inputproductid">product_id - (fill it)</label>
        <input type="number" class="form-control" id="inputproduct_id" placeholder="" name="product_id" required>
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
        <label for="inputrating">product rating - (fill it)</label>
        <input type="number" class="form-control" id="inputrating" placeholder="" name="rating" required>
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
    <?php $val=true;?>
    <input type="hidden" name="approve_sell" value="<?=$val?>" />
    <button type="submit" name="verify_product" class="btn btn-dark">Approve</button>
    </form>     
      
      <?php } else if($approve_sell) { ?>
            
      <p>approve sell</p>
      
      <?php } ?>
  
  
  
  
  
  
</body>
<?php include_once '../footer.php'; ?>
