<?php include_once '../header.php'; ?>

<?php

    session_start();
    include '../libraries/chocolates.php';
    $sub_cat_id = $_GET['sub_cat_id']; 
    $sub_cat_name = $_GET['sub_cat_name']; 
    $id_s=$_GET['id_s'];
  
    $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;
  
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
            <?php if(isset($_SESSION['user_name'])) {
                    echo '<a href="../pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
                    echo '<a href="cart_display.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart"></i></a>';
                    echo '<a href="../login/logout.php" class="nav-item nav-link">Logout</a>';
                }
                else{
                    echo '<a href="../register/register.php" class="nav-item nav-link">Register</a>
                            <a href="../login/login.php" class="nav-item nav-link">Login</a>';
                }
            ?>
        </div>
    </div>
</nav>
  
  
  <!--search bar-->
					<div id="search" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="search.php" class="form-inline input-group p-4">
      							<div class="input-group">
  								<input type="text" class="form-control" name="search_product" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
  								<div class="input-group-append">
    									<button class="btn btn-outline-light" type="submit">Search</button>
  								</div>
							</div>
    						</form>
						</div>
					</div>
  
	<br><br>
  
 <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <div class="container">
  <div class="row text-center">
    <div class="col-md-3">
      <p>Sort</p>
    </div>
    <div class="col-md-6">
    <div class="form-group">
      <select id="inputState" class="form-control" name="id_s">
        <?php if($id_s==1) { ?>
        <option value="1" selected>Default</option>
        <? } else { ?>
        <option value="1">Default</option>
        <? } ?>
        
        <?php if($id_s==2) { ?>
        <option value="2" selected>Price : Low to High</option>
        <? } else { ?>
        <option value="2">Price : Low to High</option>
        <? } ?>
        
        <?php if($id_s==3) { ?>
        <option value="3" selected>Price : High to low</option>
        <? } else {?>
        <option value="3">Price : High to low</option>
        <? } ?>
        
        <?php if($id_s==4) { ?>
        <option value="4" selected>popular</option>
        <? } else {?>
        <option value="4">popular</option>
        <? } ?>
        
      </select>
    </div>
    </div>
    <input type='hidden' name='sub_cat_id' value='<?php echo "$sub_cat_id";?>'> 
    <input type='hidden' name='sub_cat_name' value='<?php echo "$sub_cat_name";?>'>
    <div class="col-md-3">
      <button type="submit" name="sort" class="btn btn-dark">Sort</button>
    </div>
  </div>
     </div>
  </form>
  
  <?php
    // for the above form
    $sub_cat_id=$_GET['sub_cat_id'];
    $sub_cat_name=$_GET['sub_cat_name'];
    $id_s=$_GET['id_s'];
    
  ?>
   
 
 <?php
  
    $con = getCon();
    if($id_s==1)
      $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id");
    else if($id_s==2)
        $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id order by price");
    else if($id_s==3)
      $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id order by price desc");
    else
      $res = $con->query("select products.product_id,product_name,min(price) as price,rating from products inner join unique_product on products.product_id=unique_product.product_id where sub_cat_id = '$sub_cat_id' group by products.product_id order by rating desc");
  
    
    
    $product_id=Array();
    $product_name=Array();
    $product_price=Array();
    $product_rating=Array();
    
    while($ele = $res->fetch_assoc())
    {
        $product_id[]=$ele['product_id'];
        $product_name[]=$ele['product_name'];
        $product_price[]=$ele['price'];
        $product_rating[]=$ele['rating'];
    }
   
    $n=count($product_id);
    
  ?>   
    
    
    
    
  <!--code from index.php card decks logic added-->
   <p class="display-4 text-center"><?=$cat_name;?></p>
    <br>
    <?$c=1; $lim=$n/4+1; for($j=1;$j<=$lim;$j++){ ?>
    <div class="container">
  <div class="row p-2">
    <? for($i=1;$i<=4;$i++){ ?> 
    <? if(4*($j-1)+$i>$n) break; ?>
   <div class="col-md-3 text-center">
      <figure class="figure">
        <a href='../products/product_description.php?product_id=<?=$product_id[$c-1]?>&&product_name=<?=$product_name[$c-1]?>'>
          <img src="../assets/<?=$product_id[$c-1]?>.jpeg" class="figure-img img-fluid rounded mx-auto d-block" alt="product" onerror="this.src='../assets/black.png';">
        </a>
        <figcaption class="text-center">
            <h5><?=$product_name[$c-1]?></h5>
          <h5>Rating : <?=$product_rating[$c-1]?>&nbsp;&nbsp;</h5>
           <h5>Price : <?=$product_price[$c-1]?>&nbsp;&nbsp;</h5> 
           </figcaption>
      </figure>
       <!--</a>-->
    </div>
  <? $c++;} ?>
      </div> 
     </div>
    <? } ?>  
    
    
    
    
    
    
    
    
    

</body>

<style media="screen">
            .figure {display: table;margin-right: auto;margin-left: auto;}
            .figure-caption {display: table-caption;caption-side: bottom;text-align: center;}
</style>    
  

<?php include_once '../footer.php'; ?>
