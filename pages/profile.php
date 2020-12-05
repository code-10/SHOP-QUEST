<?php include_once '../header.php'; ?>
<?php include_once '../libraries/chocolates.php'; ?>
<?php session_start(); ?>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="../index.php" class="navbar-brand">ShopShop</a>
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
                    echo '<a href="#" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
                    echo '<a href="product/cart_display.php" class="nav-item nav-link active"><i class="fa fa-shopping-cart"></i></a>';
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
    
    
  <!--profile-->
    <div class="jumbotron">
        <div class="text-center">
            <?php if(isset($_SESSION['user_name'])&&$_SESSION['user_name']=="root"){
                        
                            header("Location:login/admin_enter.php");
                            die();
                        
                    }
                    else if(isset($_SESSION['user_name'])){ 
                        echo '<h1 class="display-4"> username : '.$_SESSION['user_name'].'</h1>';
                    }
                    else
                    {
                        header("Location:../index.php");
                        die();
                    }
            ?>
        </div>
    </div>
    <div class="text-center">
    <a href="product/wishlist_display.php"><button type="button" class="btn btn-dark">Wishlist</button></a><br><br>    
    <a href="product/order_display.php"><button type="button" class="btn btn-dark">orders</button></a><br><br>
    </div>
    
    <br><hr><br>
    
    <?php
        $user=$_SESSION['user_name'];
    ?>
        
    <div class="text-center">
        <? if(rowExists('seller','seller_user_name',$user)){ ?>
            <a href="login/seller_enter.php"><button type="button" class="btn btn-dark">Head to seller profile</button></a><br><br>  
        <? } else { ?>
            <a href="login/make_seller.php"><button type="button" class="btn btn-dark">Become a seller</button></a><br><br>
        <? } ?>
    </div>
    
    </body>


<?php include_once '../footer.php'; ?>
