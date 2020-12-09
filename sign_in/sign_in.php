<?php include_once '../header.php'; session_start(); ?>
<?php $visit = $_SESSION['visit']; ?>

<body>

  <!--navigation bar-->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark"> <a href="../index.php" class="navbar-brand">ShopShop</a>
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"> <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav">
				<a href="../index.php" class="nav-item nav-link">Home</a>
				<a href="../pages/about.php" class="nav-item nav-link">About</a>
			</div>
			<div class="navbar-nav ml-auto"> <a href="../register/register.php" class="nav-item nav-link">Register</a>
				<a href="#" class="nav-item nav-link active">Login</a>
			</div>
		</div>
	</nav>
  
  
  
  <!--heading-->
	<div class="container">
		<div class="text-center">
			<h2 style="color:white;background-color:black;">Sign in</h2>
		</div>
	</div>
  
  
  
  <!--display messages-->
	<?php 
	
		$signin = $_GET['signinwhich'];
	
		$wrongpassword=$_GET[ 'wrongpassword']; 
		$loginnow=$_GET['loginnow'];
		$nouser=$_GET['user'];
		$userexists=$_GET['userexists'];
		$emailexists=$_GET['emailexists'];
		$error=$_GET['error'];
		$commonpassword=$_GET['commonpassword'];
		$invalidusername=$_GET['invalidusername'];
	
	?>
	<div class="container">
		<div class="text-center">
			<?php 
				if($wrongpassword)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Your user_name or password is wrong</div></h4>";
				else if($loginnow)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-primary' role='danger'>Login to continue</div></h4>";
				else if($invalidusername)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Username shouldn't contain special characters</div></h4>";
		            	else if($commonpassword)
		                 	echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Try Entering a secure password</div></h4>";
		            	else if($userexists)
		                	echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>User Already exists</div></h4>";
		            	else if($emailexists)
		                	echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Email is already registered</div></h4>";
		            	else if($nouser)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>You don't have a Shopquest Account, Kindly Register</div></h4>";
				else if($error)
		                	echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Something happened try again</div></h4>";
						
			?>
		</div>
	</div>
  
  

<div class="container">
    	<div class="row d-flex justify-content-center">
			<div class="col-md-6 col-md-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row d-flex justify-content-center">
							<div class="col-xs-6 col-lg-5 col-md-5 col-sm-5 col-5 m-2 text-center">
								<a href="#" class="active" id="login-form-link" style="color:black;">Login</a>
							</div>
							<div class="col-xs-6 col-lg-5 col-md-5 col-sm-5 col-5 m-2 text-center">
								<a href="#" id="register-form-link" style="color:black;">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row d-flex justify-content-center">
							<div class="col-lg-12">
								
								<form  id="login-form" method="POST" action="login_details.php" style="display: block;">
									<div class="form-group">
			              <label for="inputEmail">Username</label>
			                <input type="text" class="form-control" id="inputuser_name" placeholder="username" name="user_name" required>
		              </div>
		              <div class="form-group">
			                <label for="inputPassword">Password</label>
			                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
		              </div>
		                  <button type="submit" name="login_user" class="btn btn-dark">Sign in</button>
								</form>
								
								<form method="POST" action="register_details.php" id="register-form" style="display: none;">
									<div class="form-group">
					          <label for="inputuser">Username</label>
					            <input type="text" class="form-control" id="inputuser_name" placeholder="username" name="user_name" value="<?=$userfill?>" required>
				          </div>
				          <div class="form-group">
					            <label for="inputEmail">Email</label>
					            <input type="email" class="form-control" id="inputEmail" placeholder="email" name="email" value="<?=$emailfill?>" required>
				          </div>
				          <div class="form-group">
					            <label for="inputPassword">Password</label>
					            <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
				          </div>
					            <button type="submit" name="register_user" class="btn btn-dark">Register</button>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
  
  
  
  
  
  
  
	<script>
		
		/*var signin = <?php print($signinwhich); ?>
	
		if(signin=="login")
		{
			$("#login-form").delay(100).fadeIn(100);
 			$("#register-form").fadeOut(100);
			$('#register-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		}
		else if(signin=="register")
		{
			$("#register-form").delay(100).fadeIn(100);
 			$("#login-form").fadeOut(100);
			$('#login-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		}
			*/
		
		
	$(function() {
    		$('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
		$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

	
	
	</script>
  
  
  
  
  
  
  
  
  
  
</body>


<?php include_once '../footer.php'; ?>
