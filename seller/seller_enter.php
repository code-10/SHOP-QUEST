<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>

<?php 
      
      session_start(); 

      if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	} 



      
      $seller_enter_main=$_GET['seller_enter_main'];
      $sell_a_product=$_GET['sell_a_product'];
      $my_sell_requests=$_GET['my_sell_requests'];

      $categories=Array();
      $sub_categories=Array();

      $res1=$con-query("select * from categories");
      while($ele1=$res1->fetch_assoc())
      {
            $categories[]=$ele1['cat_name'];     
      }

      $res2=$con->query("select * from sub_categories");
      while($ele2=$res2->fetch_assoc())
      {
            $sub_categories[]=$ele2['sub_cat_name'];     
      }

      $c=count($categories);
      $sc=count($sub_categories);
      

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


      <?php if($seller_enter_main=="yes") { ?>
      
            <a class="btn btn-primary" href="seller_enter.php?sell_a_product=yes" role="button">Sell a product</a>
            <a class="btn btn-primary" href="seller_enter.php?my_sell_requests=yes" role="button">My sell requests</a>
      
      <?php } else if($sell_a_product=="yes") { ?>
      
            <form class="jumbotron m-4" method="POST" action="seller_enter.php">
                  <div class="form-group">
    				<select class="form-control" id="category" name="category">
                              <?php for($i=0;$i<$c;$i++) { ?>
					      <option value="<?=$categories[$i]?>"><?=$i+1?> - <?=$categories[$i]?></option>
				      <?php } ?>
    				</select>
  		      </div>
                  <div class="form-group">
    				<select class="form-control" id="category" name="sub_category">
                              <?php for($j=0;$j<$sc;$j++) { ?>
					      <option value="<?=$sub_categories[$j]?>"><?=$j+1?> - <?=$sub_categories[$j]?></option>
					<?php } ?>
    				</select>
  		      </div>
    <div class="form-group">
        <label for="inputpro">product</label>
        <input type="text" class="form-control" id="inputpro" placeholder="product" name="pro" required>
    </div>
    <div class="form-group">
        <label for="inputdesc">Description</label>
        <input type="text" class="form-control" id="inputdesc" placeholder="desc" name="desc" required>
    </div>
    <div class="form-group">
        <label for="inputbrand">brand</label>
        <input type="text" class="form-control" id="inputbrand" placeholder="brand" name="brand" required>
    </div>
    <div class="form-group">
        <label for="inputsize">size</label>
        <input type="text" class="form-control" id="inputsize" placeholder="size" name="size" required>
    </div>
    <div class="form-group">
        <label for="inputcolor">color</label>
        <input type="text" class="form-control" id="inputcolor" placeholder="color" name="color" required>
    </div>
    <div class="form-group">
        <label for="inputcolor">Price</label>
        <input type="number" class="form-control" id="inputprice" placeholder="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="inputqty">quantity</label>
        <input type="number" class="form-control" id="inputqty" placeholder="qty" name="qty" required>
    </div>
    <button type="submit" name="sell_a_product" class="btn btn-dark">Sell product</button>
    </form>
      
      <?php } else if($my_sell_requests=="yes") { ?>
      
      <?php } ?>
  

      
      
  
</body>
      
      






<?php include_once '../footer.php'; ?>
