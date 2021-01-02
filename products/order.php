<?php

      	include_once '../header.php';
      	include_once '../libraries/chocolates.php';
      	session_start();

      	$con=getCon();
      
      	$user=$_SESSION['user_name'];
      	$final_price=$_POST['final_price'];
	$address=$_POST['address'];

	
      if(isset($_POST['done']))
      {
	     
	    $con->query("insert into orders(user_name,total_price,user_address) values('$user','$final_price','$address')");
	    
	    $order_id=$con->query("select * from orders where user_name='$user' order by order_date desc");
	    $order_id_store=Array();
	    while($count=$order_id->fetch_assoc())
		    $order_id_store[]=$count['order_id'];
	    
	    $i_order_id=$order_id_store[0];
	      
	    $unique_type_id=Array();
	    $quantity=Array();
	    $cart_no=$con->query("select * from cart where user_name='$user'");
	    while($ele=$cart_no->fetch_assoc())
	    {
		$unique_type_id[]=$ele['unique_type_id'];
		$quantity[]=$ele['qty'];
	    }
	      
	    $c=count($unique_type_id);
	      
	    for($i=0;$i<$c;$i++)
	    {
	    	$con->query("insert into order_contents(order_id,unique_type_id,qty) values('$i_order_id','$unique_type_id[$i]','$quantity[$i]')");
	    }
	    
	    
	    for($j=0;$j<$c;$j++)
	    {
		$quantity_up=$con->query("select quantity from unique_product where unique_type_id='$unique_type_id[$j]'");  
		$quantity_ans=Array();
		while($out=$quantity_up->fetch_assoc())
			$quantity_ans[]=$out['quantity'];
		$updated_quantity=$quantity_ans[0]-$quantity[$j];
		$con->query("update unique_product set quantity='$updated_quantity' where unique_type_id='$unique_type_id[$j]'");
	    }  
	      
	    $con->query("delete from cart where user_name = '$user'");
	      
	   
	      
	    header("Location:user_orders.php?order_placed=yes");
            die();       
      }

      if(!(isset($_SESSION['user_name'])))
      {
            header("Location:../index.php");
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
	
		$cart=$con->query("select c.user_name,p.product_name,up.unique_type_id,up.price,c.qty,up.color,up.size,up.quantity from products as p,cart as c,unique_product as up where p.product_id=up.product_id and c.unique_type_id=up.unique_type_id and user_name='$user'");
		
		$product_name=Array();
		$product_price=Array();
		$product_color=Array();
		$product_size=Array();
		$product_qty=Array();
		$unique_type_id=Array();
			
		while($ele=$cart->fetch_assoc())
		{
			$product_name[]=$ele['product_name'];
			$product_price[]=$ele['price'];
			$product_color[]=$ele['color'];
			$product_size[]=$ele['size'];
			$product_qty[]=$ele['qty'];
			$unique_type_id[]=$ele['unique_type_id'];
		}	
	
		$n=count($product_name);
	
		$total_price=0;
		for($i=0;$i<$n;$i++)
		{
			$total_price=$total_price+($product_qty[$i]*$product_price[$i]);
		}
	
	
	
	
	
	
	
		/*Discount*/
		$discount_calc=$con->query("select * from orders where user_name = '$user'");
		$discount_data=Array();
		while($ele = $discount_calc->fetch_assoc())
		{
            		$discount_data[]=$ele['total_price'];
		}

		$discount=0;
		$total=0;

		foreach($discount_data as $d)
        	{
             		$total=$total+$d;
        	}
	
		if($total>10000)
          		$discount=$total_price*0.01;
        	if($total>20000)
          		$discount=$total_price*0.02;
        	if($total>30000)
          		$discount=$total_price*0.03;
        	if($total>40000)
          		$discount=$total_price*0.04;
        	if($total>50000)
          		$discount=$total_price*0.05;
        	if($total>60000)
          		$discount=$total_price*0.06;
        	if($total>70000)
          		$discount=$total_price*0.07;
        	if($total>80000)
          		$discount=$total_price*0.08;
        	if($total>90000)
          		$discount=$total_price*0.09;
        	if($total>100000)
          		$discount=$total_price*0.10;

		$final_price = $total_price-$discount;
	
		/*Discount*/
	
	?>
	
	

<?php for($i=0;$i<$n;$i++) { ?>	
	<div class="row m-4 d-flex justify-content-end">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><?=$product_name[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><?=$product_color[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><?=$product_size[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><p><?=$product_qty[$i]?></p></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$product_qty[$i]*$product_price[$i]?></p></div>
	</div>

<?php } ?>	

        <div class="row m-4 d-flex justify-content-end">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><h5 style="margin-bottom:0px;">Total Price </h5></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><h5 style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$total_price?></h5></div>
	</div>	
	<div class="row m-4 d-flex justify-content-end">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><h5 style="margin-bottom:0px;">Exclusive Discount </h5></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><h5 style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$discount?></h5></div>
	</div>	
	<div class="row m-4 d-flex justify-content-end">
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><p style="margin-bottom:0px;"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><h5 style="margin-bottom:0px;">Total after discount </h5></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-7"><h5 style="margin-bottom:0px;"><i class="fa fa-rupee"></i> <?=$final_price?></h5></div>
	</div>	
	
<div class="m-4 d-flex justify-content-center">
	<form method="POST" action="order.php">
	<div class="col">
  			<div class="form-group">
    				<label for="exampleFormControlTextarea1">Enter your Address</label>
    				<textarea class="form-control" name="address" rows="4" cols="48" required></textarea>
  			</div>
	</div>
	<div class="col">
  			<div class="form-group">
    				<label for="exampleFormControlTextarea1">Enter total price</label>
				<input type="number" class="form-control"  name="price" placeholder="Just enter the total price" value="<?=$final_price?>" disabled>
  			</div>
	</div>

	
	
	<?php
		if ($_POST) {
			
			$razorpay_payment_id = $_POST['razorpay_payment_id'];
			
		}
			
	?>
	
	
		    <div class="container text-center">
			    <input type="hidden" name="final_price" value="<?=$final_price?>" />
			    <button type="submit" class="btn btn-dark btn-block mb-4" name="done" <?php if(!$razorpay_payment_id) { ?> disabled <?php } ?>   >Place your order</button>
		    </div>

	</form>
</div>
	
	
	
	<!--razor pay-->
	<div class="text-center">
		
	<?php
		if ($_POST) {
			
			$razorpay_payment_id = $_POST['razorpay_payment_id'];
	
			//echo "Razorpay success ID: ". $razorpay_payment_id;
			if($razorpay_payment_id)
				echo '<h5 class="badge bg-success p-2">Payment Successful</h5>';
		}
	?>	
		
	<?php $razor_api_key = "rzp_test_OI6pn5SyocGvBv"; ?>
		
	<?php 
		
		//converting rupees to paisa
		$razor_price=$final_price*100;
			
	?>
	
	<style>
      .razorpay-payment-button {
	     margin:16px;
        color: #ffffff !important;
        background-color: #000000;
        border-color: #7266ba;
        font-size: 14px;
        padding: 10px;
      }
    </style>
	<form action="order.php" method="POST">
    	<script
        	src="https://checkout.razorpay.com/v1/checkout.js"
        	data-key="<?php echo $razor_api_key; ?>"
        	data-amount="<?php echo $razor_price; ?>"
        	data-buttontext="Pay with Razorpay"
        	data-name="ShopQuest"
        	data-description="Pay for ShopQuest"
        	data-image="../assets/black.png"
        	data-prefill.name="John Doe"
        	data-prefill.email=""
        	data-theme.color="#9932CC">
	</script>
    	<input type="hidden" value="Hidden Element" name="hidden">
	</form>
		
	</div>
	<!--razor pay end-->
	
	

	
	
	
	
 <?php include_once '../footer.php';
