<?php
        include_once '../header.php';
        session_start();
        include '../libraries/chocolates.php';

        $con = getCon();
        $user=$_SESSION['user_name'];
        $product_id=Array();
        $product_name=Array();
        $res = $con->query("select products.product_id,product_name from products inner join unique_product on products.product_id=unique_product.product_id where seller_user_name='$user'");
        while($ele = $res->fetch_assoc())
        {
         $product_id[]=$ele['product_id'];
        $product_name[]=$ele['product_name'];
        }
      $n=count($product_id);  
        
?>




<style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
    }
</style>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>



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

     
        
 <div class="jumbotron">
        <div class="text-center">
              <h4>Products</h4>
        </div>
    </div>  
	



	<a class="btn btn-dark ml-4" href="seller_enter.php?seller_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
	
	<? for($i=0;$i<$n;$i++) {
     $price=Array();
     $color=Array();
     $size=Array();
     $qty=Array();
   $res = $con->query("select * from unique_product where seller_user_name='$user' and product_id='$product_id[$i]' ");
   while($ele = $res->fetch_assoc())
        {
         $price[]=$ele['price'];
         $color[]=$ele['color'];
         $size[]=$ele['size'];
         $qty[]=$ele['quantity'];
        }    ?>
        
    <button type="button" class="collapsible"><?=$product_name[$i]?></button>
    <div class="content">
        <p><?=$size[$i]?></p>
    </div>
  
  
  
  <? } ?>

 
 
 
  
</body>

<?php include_once '../footer.php'; ?>
