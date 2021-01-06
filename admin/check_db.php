<?php
        include_once '../header.php';
        session_start();
        include '../libraries/chocolates.php';
        $category=Array();
        $con = getCon();
        $res = $con->query("select * from categories");
        while($ele = $res->fetch_assoc())
            $category[]=$ele;
        
       
        if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	}


        $sub_category=Array();
        $res = $con->query("select * from sub_categories");
        while($ele = $res->fetch_assoc())
            $sub_category[]=$ele;



        
        $products=Array();
        $res = $con->query("select * from products");
        while($ele = $res->fetch_assoc())
            $products[]=$ele;




        $uniq_prod=Array();
        $res = $con->query("select * from unique_product");
        while($ele = $res->fetch_assoc())
            $uniq_prod[]=$ele;
        
        
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

     
        
 <div class="jumbotron">
        <div class="text-center">
              <h4>Database Details</h4>
        </div>
    </div>  
	
	
	<a class="btn btn-dark ml-4" href="admin_enter.php?admin_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
	
	<?php
	
		$view=$_GET['view'];
	
	?>
	
	<div class="text-center m-4">
            <a class="btn btn-primary m-2" href="check_db.php?view=category" role="button">Category</a>
	    <a class="btn btn-primary m-2" href="check_db.php?view=sub_category" role="button">Sub_category</a>
            <a class="btn btn-primary m-2" href="check_db.php?view=products" role="button">Products</a>
	    <a class="btn btn-primary m-2" href="check_db.php?view=unique_product" role="button">Unique_product</a>
	</div>
	
   
        
        
	<?php if($view=="category") { ?>
            
               <div class="card">
                        
                     <div class="row m-2">
                        
                     <? foreach($category as $cat) { ?>
                        
                        <div class="card col-12 col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding:0px;">
				<div class="card-body">
                                        <p class="card-text"><h6>Cat_id</h6> <?=$cat['cat_id']?></p>
                                        <p class="card-text"><h6>Cat_name</h6> <?=$cat['cat_name']?></p>
                        	</div>
                        </div>
                     <? } ?>
			</div>	
		  </div>
                        
        <?php } else if($view=="sub_category") { ?>
            
        <div class="card">
                        
                        <div class="row m-2">
                        
                   <? foreach($sub_category as $cat) { ?>
                        
                        <div class="card col-12 col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding:0px;">
                                <div class="card-body">
                                        <p class="card-text"><h6>Sub_cat_id</h6> <?=$cat['sub_cat_id']?></p>
                                        <p class="card-text"><h6>Sub_cat_name</h6> <?=$cat['sub_cat_name']?></p>
                                        <p class="card-text"><h6>Cat_id</h6> <?=$cat['cat_id']?></p>
                                </div>
                        </div>
                        
                   <? } ?>
                        
                        </div>
                        
            </div>
        <?php } else if($view=="products") { ?>

        <div class="card">
                        
                        <div class="row m-2">
                        
                   <? foreach($products as $p) { ?>
                        
                        <div class="card col-12 col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding:0px;">
                                <div class="card-body">
                                        <p class="card-text"><h6>Sub_cat_id</h6> <?=$p['sub_cat_id']?></p>
                                        <p class="card-text"><h6>Product_id</h6> <?=$p['product_id']?></p>
                                        <p class="card-text"><h6>Product_name</h6> <?=$p['product_name']?></p>
                                        <p class="card-text"><h6>Product_brand</h6> <?=$p['product_brand']?></p>
                                        <p class="card-text"><h6>Product_description</h6> <?=$p['product_description']?></p>
                                        <p class="card-text"><h6>Product_rating</h6> <?=$p['rating']?></p>

                                        <form method="POST" action="edit_or_delete_from_db.php">
                                                <input type="hidden" name="edit_delete_product_id" value="<?=$p['product_id']?>" />
					        <button type="submit" class="fa fa-edit btn btn-success btn-sm pm" name="edit_info_p"></button> 
                                                <button type="submit" class="fa fa-trash btn btn-danger btn-sm pm" name="delete_info_p"></button> 
				        </form>

                                </div>
                        </div>
                        
                    <? } ?>
                                
                        </div>
                        
            </div>
	<?php } else if($view=="unique_product") { ?>
            
        <div class="card">
                        
                        <div class="row m-2">
                        
                   <? foreach($uniq_prod as $p) { ?>
                        
                        <div class="card col-12 col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding:0px;">
                                <div class="card-body">
                                        <p class="card-text"><h6>Product_id</h6> <?=$p['product_id']?></p>
                                        <p class="card-text"><h6>Unique_type_id</h6> <?=$p['unique_type_id']?></p>
                                        <p class="card-text"><h6>Product_price</h6> <?=$p['price']?></p>
                                        <p class="card-text"><h6>Product_quantity</h6> <?=$p['quantity']?></p>
                                        <p class="card-text"><h6>Product_seller_user_name</h6> <?=$p['seller_user_name']?></p>
                                        <p class="card-text"><h6>Product_color</h6> <?=$p['color']?></p>
                                        <p class="card-text"><h6>Product_size</h6> <?=$p['size']?></p>

                                         <form method="POST" action="edit_or_delete_from_db.php">
                                                <input type="hidden" name="edit_delete_unique_type_id" value="<?=$p['unique_type_id']?>" />
					        <button type="submit" class="fa fa-edit btn btn-success btn-sm pm" name="edit_info_u"></button> 
                                                <button type="submit" class="fa fa-trash btn btn-danger btn-sm pm" name="delete_info_u"></button> 
				        </form>
                                        
                                </div>
                        </div>
                        
                        <? } ?>

                        </div>

            </div> 
            <?php } ?>
        
  
  
  
  
</body>

<?php include_once '../footer.php'; ?>
