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
	<div class="jumbotron">
		<div class="text-center">
			<p class="display-4">Sign in</p>
		</div>
	</div>
  
  
  
  <!--display messages-->
	<?php 
		$wrongpassword=$_GET[ 'wrongpassword']; 
		$loginnow=$_GET['loginnow'];
	?>
	<div class="container">
		<div class="text-center">
			<?php 
				if($wrongpassword)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Your user_name/email or password is wrong</div></h4>";
				else if($loginnow)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-primary' role='danger'>Login to continue</div></h4>";
			?>
		</div>
	</div>
  
  

<div class="container">
    	<div class="row d-flex justify-content-center">
			<div class="col-md-6 col-md-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row d-flex justify-content-center">
							<div class="col-xs-6 col-lg-5 col-md-5 col-sm-5 col-5 m-2 text-center" style="color:black;">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6 col-lg-5 col-md-5 col-sm-5 col-5 m-2 text-center" style="color:black;">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row d-flex justify-content-center">
							<div class="col-lg-12">
								
								<form  id="login-form" method="POST" action="login_details.php" style="display: block;">
									<div class="form-group">
			              <label for="inputEmail">Username/email</label>
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
