  
<?php
        include_once '../header.php';
        session_start();
        include '../libraries/chocolates.php';

        $con = getCon();  
       
        if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	}

        $do_it=$_GET['do_it'];
	$show_this=$_GET['show_this'];
	$rar_process_id_sent=$_GET['rar_process_id_sent'];
        $show_another=$_GET['show_another'];
        
?>

<?php

	if($do_it=="return")
	{
		$con->query("update process_return_or_replace set status=2 where process_return_or_replace_id='$rar_process_id_sent'");
		header("Location:user_request.php?show_this=2");
		die();
	}
	else if($do_it=="replace")
	{
		$con->query("update process_return_or_replace set status=3 where process_return_or_replace_id='$rar_process_id_sent'");
		header("Location:user_request.php?show_this=2");
		die();
	}
	else if($do_it=="reject")
	{
		$con->query("update process_return_or_replace set status=4 where process_return_or_replace_id='$rar_process_id_sent'");
		header("Location:user_request.php?show_this=4");
		die();
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

     
        
 <div class="jumbotron">
        <div class="text-center">
              <h4>Return or Replace</h4>
        </div>
    </div>  
	
	
	<a class="btn btn-dark m-4" href="admin_enter.php?admin_enter_main=yes" role="button"><i class="fa fa-arrow-circle-left mr-2"></i>Back to main menu</a>
	
	<?php 
		
		$rar_category=Array();
		$rar_sub_category=Array();
		$rar_product_name=Array();
		$rar_color=Array();
		$rar_size=Array();
		$rar_quantity=Array();
		$rar_rating=Array();
		$rar_product_brand=Array();
		$rar_product_description=Array();
		$rar_price=Array();
		$rar_seller_user_name=Array();
		$rar_unique_type_id=Array();
		$rar_user_name=Array();
		$rar_status=Array();
		$rar_process_id=Array();
	
		$rar_process = $con->query("select c.cat_name,sc.sub_cat_name,p.product_name,p.product_brand,p.product_description,p.rating,up.price,pr.quantity,up.size,up.color,up.seller_user_name,up.unique_type_id,pr.user_name,pr.status,pr.process_return_or_replace_id from categories as c,sub_categories as sc,products as p,unique_product as up,process_return_or_replace as pr where pr.unique_type_id=up.unique_type_id and p.product_id=up.product_id and p.sub_cat_id=sc.sub_cat_id and c.cat_id=sc.cat_id");
	
		while($rar_do=$rar_process->fetch_assoc()){
			$rar_category[]=$rar_do['cat_name'];
			$rar_sub_category[]=$rar_do['sub_cat_name'];
			$rar_product_name[]=$rar_do['product_name'];
			$rar_color[]=$rar_do['color'];
			$rar_size[]=$rar_do['size'];
			$rar_quantity[]=$rar_do['quantity'];
			$rar_rating[]=$rar_do['rating'];
			$rar_product_brand[]=$rar_do['product_brand'];
			$rar_product_description[]=$rar_do['product_description'];
			$rar_price[]=$rar_do['price'];
			$rar_seller_user_name[]=$rar_do['seller_user_name'];
			$rar_unique_type_id[]=$rar_do['unique_type_id'];
			$rar_user_name[]=$rar_do['user_name'];
			$rar_status[]=$rar_do['status'];
			$rar_process_id[]=$rar_do['process_return_or_replace_id'];
		}
		
		$n=count($rar_unique_type_id);
	
	?>
	
	
	
	
	
	
	<div class="text-center m-4">
            <a class="btn btn-primary m-2" href="user_request.php?show_this=1" role="button">Pending</a>
	    <a class="btn btn-primary m-2" href="user_request.php?show_this=2&&show_another=3" role="button">Approved</a>
            <a class="btn btn-primary m-2" href="user_request.php?show_this=4" role="button">Rejected</a>
	</div>
	
	
	
	<?php for($i=0;$i<$n;$i++) { ?>
	
		<? if($show_this!=$rar_status[$i]&&$show_another!=$rar_status[$i]) continue; ?>
	
		<div class="card m-4">
  			<h5 class="card-header"><?=$rar_user_name[$i]?></h5>
  			<div class="card-body">
    				<p class="card-text">product name : <?=$rar_product_name[$i]?></p>
				<p class="card-text">product brand : <?=$rar_product_brand[$i]?></p>
				<p class="card-text">category : <?=$rar_category[$i]?></p>
				<p class="card-text">sub_category : <?=$rar_sub_category[$i]?></p>
				<p class="card-text">rating : <?=$rar_rating[$i]?></p>
				<p class="card-text">price for one : <?=$rar_price[$i]?></p>
				<p class="card-text">color : <?=$rar_color[$i]?></p>
				<p class="card-text">size : <?=$rar_size[$i]?></p>
				<p class="card-text">product descriptiom : <?=$rar_product_description[$i]?></p>
				<p class="card-text">quantity : <?=$rar_quantity[$i]?></p>
				<p class="card-text">seller_user_name : <?=$rar_seller_user_name[$i]?></p>
				
				<?php if($rar_status[$i]==1) { ?>
					<a href='user_request.php?do_it=replace&&rar_process_id_sent=<?=$rar_process_id[$i]?>' class="btn btn-primary btn-sm m-2">Replace</a>
					<a href='user_request.php?do_it=return&&rar_process_id_sent=<?=$rar_process_id[$i]?>' class="btn btn-primary btn-sm m-2">Return</a>
					<a href='user_request.php?do_it=reject&&rar_process_id_sent=<?=$rar_process_id[$i]?>' class="btn btn-danger btn-sm m-2">Reject</a>
				<?php } else if($rar_status[$i]==2) { ?>
					<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-success">RETURNED</span></h6>
				<?php } else if($rar_status[$i]==3) { ?>
					<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-success">REPLACED</span></h6>
				<?php } else if($rar_status[$i]==4) { ?>
					<h6 class="card-text">Status&nbsp&nbsp<span class="badge badge-danger">Rejected</span></h6> 
				<?php } ?>
				
  			</div>
		</div>
	
	<?php } ?>
	
	
	
	
	
	
  
  <?php include_once '../footer.php'; ?>
