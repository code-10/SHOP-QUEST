<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>
<?php session_start(); ?>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">ShopQuest</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
        </div>
        <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_name'])){
                    echo '<a href="#" class="nav-item nav-link active"><i class="fa fa-user-o"> '.$_SESSION['user_name'].'</i></a>';
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
    
    
  <!--profile-->
    <div class="jumbotron">
        <div class="text-center">
            <?php if(isset($_SESSION['user_name'])&&$_SESSION['user_name']=="root"){
                        
                            header("Location:../admin/admin_enter.php?admin_enter_main=yes");
                            die();
                        
                    }
                    else if(isset($_SESSION['user_name'])){ 
                      
                        $user=$_SESSION['user_name'];
                        $user[0]=strtoupper($user[0]);
                        
                        echo '<h1 class="display-6 mb-5"> <i class="fa fa-user-circle"></i>  '.$user.'</h1>';
                    }
                    else
                    {
                        header("Location:../index.php");
                        die();
                    }
            ?>
        </div>
      
         <div class="text-center">
            <a href="../products/wishlist.php"><button type="button" class="btn btn-dark">Your Wishlist</button></a><br><br>    
            <a href="../products/user_orders.php?your_orders=yes"><button type="button" class="btn btn-dark">Your Orders</button></a><br><br>
        </div>
      
    </div>
   
    
    <br><br>
    
    <?php
        $user=$_SESSION['user_name'];
    ?>
        
    <div class="text-center">
        <? if(rowExists('seller','seller_user_name',$user)){ ?>
            <a href="../seller/seller_enter.php?seller_enter_main=yes"><button type="button" class="btn btn-dark">Head to seller profile</button></a><br><br>  
        <? } else { ?>
            <a href="../seller/seller_confirm.php"><button type="button" class="btn btn-dark">Become a seller</button></a><br><br>
        <? } ?>
    </div>
    
    </body>


<?php include_once '../footer.php'; ?>
