<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
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
  
  
 <?php
        
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
    
    
    
    ?>
    
  <!--Enter data into categories-->
    <div class="jumbotron">
        <div class="text-center">
            <a href="admin_enter.php"><button type="button" class="btn btn-dark m-2">Enter</button></a>
        </div>
    </div>
     
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
    
    <!--<a href='admin_display.php?storeinfoid=<?=$storeinfoid[$i]?>' class="btn btn-primary">Edit to Approve</a>-->
    <a href='#' class="btn btn-primary">Edit to Approve</a>
    <a href="#" name="delete_info" class="btn btn-primary">delete</a>

</div>
</div>  
  <? } ?>   
  
  
  
  
  
  
  
  
</body>
<?php include_once '../footer.php'; ?>
