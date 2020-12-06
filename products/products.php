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
  
  
  <!--Search bar-->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <form  method="GET" action="../search.php">
      <div class="text-center">
            <input type="text" class="form-control mr-sm-2" placeholder="Search" name="search_product" required><br>
            <button type="submit" class="btn btn-outline-dark my-sm-0">Search</button>
      </div>
    </form>
  </div>
</div>
  
  
  
 <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <div class="container">
  <div class="row text-center">
    <div class="col">
      <p>Sort</p>
    </div>
    <div class="col">
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
    <div class="col">
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
   
    
    

</body>

<style media="screen">
            .figure {display: table;margin-right: auto;margin-left: auto;}
            .figure-caption {display: table-caption;caption-side: bottom;text-align: center;}
</style>    
  

<?php include_once '../footer.php'; ?>
