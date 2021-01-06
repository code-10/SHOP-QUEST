<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>
<?php session_start(); 

      if(!(isset($_SESSION['user_name'])))
      	{
            header("Location:../index.php");
            die(); 
      	} 

      $con=getCon();

      
      $user=$_SESSION['user_name'];
      $confirm=$_GET['confirm'];
      if($confirm=="yes"){
      if(($con->query("insert into seller(seller_user_name,seller_email,seller_password) select user_name,email,password from user where user_name='$user'"))===True)
      {
            $newuser=true;
            header("Location:seller_enter.php?seller_enter_main=yes");
            die();
      }
      else
      {
            header("Location:../profile.php");
            die();
      }
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
    
  
  
  
    <div class="text-center m-4">
      <p class="lead">
          You agree to all terms and conditions of selling on ShopQuest.
      </p>
      <a href="seller_confirm.php?confirm=yes"><button type="button" class="btn btn-success">Confirm</button></a>
    </div>
  
  
  
  
    
  
    
    </body>


<?php include_once '../footer.php'; ?>
