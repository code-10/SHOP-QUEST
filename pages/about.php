<?php include '../header.php'; ?>

<body>
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">ShopShop</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="#" class="nav-item nav-link active">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
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
         <p class="display-3">About</p>
      <p class="m-4"><a href="https://github.com/code-10/SHOP-QUEST"><i class="fa fa-github mr-2" style="color:black;"></i>Github Repository - Shopquest</a></p>
      </div>
   </div>
</body>
  
  
  <?php include '../footer.php'; ?>
