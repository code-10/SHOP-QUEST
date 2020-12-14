<?php include_once '../header.php'; ?>

<?php

  session_start();
  include_once '../libraries/chocolates.php';

  $cat_id = $_GET['cat_id']; 
  $cat_name = $_GET['cat_name']; 

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
  
  
<!--search bar-->
					<div id="search" class="mb-2" style="background-color:black;">
						<div class="text-center">
						<form method="GET" action="../pages/search.php" class="form-inline input-group d-flex justify-content-center" style="padding:0.60rem!important">
      							<div class="input-group">
  								<input type="text" class="form-control" name="search_product" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
  								<div class="input-group-append">
    									<button class="btn btn-outline-light" type="submit">Search</button>
  								</div>
							</div>
    						</form>
						</div>
					</div>
  
  
  <?php
  
    $con = getCon();
    
    $res = $con->query("select * from sub_categories where cat_id = '$cat_id'");
    
    $sub_cat_name= array();
    $sub_cat_id= array();
  
    while($ele = $res->fetch_assoc()){
      $sub_cat_name[]=$ele['sub_cat_name'];
      $sub_cat_id[]=$ele['sub_cat_id'];
    }
    
    $n = count($sub_cat_id);
   
     
  ?>
 
  
  
    <h3 class="text-center"><?=$cat_name;?></h3>
    <br>
    
    <?$c=1; $lim=$n/4+1; for($j=1;$j<=$lim;$j++){ ?>
    <div class="container">
      <div class="row p-2 d-flex justify-content-center">
        <? for($i=1;$i<=3;$i++){ ?> 
        <? if(3*($j-1)+$i>$n) break; ?>
        <div class="col-md-3 col-4 text-center">
            <figure class="figure">
                <a href='../products/product.php?sub_cat_id=<?=$sub_cat_id[$c-1]?>&&sub_cat_name=<?=$sub_cat_name[$c-1]?>&&id_s=1'>
                  <img src="..." class="img-fluid" onerror="this.src='../assets/black.png';">
                </a>
                <figcaption class="figure-caption text-center">
                    <p><?=$sub_cat_name[$c-1]?></p>
                </figcaption>
            </figure>
        </div>
        <? $c++;} ?>
      </div>
    </div>
<? } ?>
  
  
  
</body>


<?php include_once '../footer.php'; ?>
