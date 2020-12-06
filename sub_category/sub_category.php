<?php include_once '../header.php'; ?>

<?php

  session_start();
  include_once '../libraries/chocolates.php';

  $cat_id = $_GET['cat_id']; 
  $cat_name = $_GET['cat_name']; 
  

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
                    echo '<a href="../product/cart_display.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart"></i></a>';
                    echo '<a href="../login/logout.php" class="nav-item nav-link">Logout</a>';
                }
                else{
                    echo '<a href="../register/register.php?visit=<?php echo $_SERVER['QUERY_STRING']; ?>" class="nav-item nav-link">Register</a>
                            <a href="../login/login.php?visit=<?php echo $_SERVER['QUERY_STRING']; ?>" class="nav-item nav-link">Login</a>';
                }
            ?>
        </div>
    </div>
</nav>
  
  
 <!--Search bar-->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <form  method="GET" action="../pages/search.php">
      <div class="text-center">
            <input type="text" class="form-control mr-sm-2" placeholder="Search" name="search_product" required><br>
            <button type="submit" class="btn btn-outline-dark my-sm-0">Search</button>
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
 
 

    <p class="display-4 text-center"><?=$cat_name;?></p>
    <br>
    
    <?$c=1; $lim=$n/4+1; for($j=1;$j<=$lim;$j++){ ?>
    <div class="container">
      <div class="row p-2">
        <? for($i=1;$i<=4;$i++){ ?> 
        <? if(4*($j-1)+$i>$n) break; ?>
        <div class="col-md-3 text-center">
            <figure class="figure">
                <a href='../product/products.php?sub_cat_id=<?=$sub_cat_id[$c-1]?>&&sub_cat_name=<?=$sub_cat_name[$c-1]?>&&id_s=1'>
                  <img src="../cats/<?=$cat_name?>/sbct<?=$c?>.jpg" class="img-fluid" onerror="this.src='../assets/black.png';">
                </a>
                <figcaption class="figure-caption text-center">
                    <h5><?=$sub_cat_name[$c-1]?></h5>
                </figcaption>
            </figure>
        </div>
        <? $c++;} ?>
      </div>
    </div>
<? } ?>
  
  
  
</body>





<?php include_once '../footer.php'; ?>
