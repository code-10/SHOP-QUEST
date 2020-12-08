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
			<p class="display-4">Login</p>
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
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Your user_name or password is wrong</div></h4>";
				else if($loginnow)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-primary' role='danger'>Login to continue</div></h4>";
			?>
		</div>
	</div>
  
  
  <!--Login form-->
	<form class="jumbotron m-4" method="POST" action="login_details.php">
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
</body>


<?php include_once '../footer.php'; ?>
