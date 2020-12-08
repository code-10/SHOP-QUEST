<?php include_once '../header.php'; session_start(); ?>
<?php $visit=$_SESSION['visit']; ?>

		<body>
    			<!--navigation bar-->
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
						<a href="#" class="nav-item nav-link active">Register</a>
						<a href="../login/login.php" class="nav-item nav-link">Login</a>
					</div>
				</div>
			</nav>
      
      
      			<!--register-->
			<div class="jumbotron">
				<div class="text-center">
					<p class="display-4">Register</p>
				</div>
			</div>
      
      
      
			<?php
      
			$nouser=$_GET['user'];
		        $userexists=$_GET['userexists'];
		        $emailexists=$_GET['emailexists'];
		        $error=$_GET['error'];
		        $commonpassword=$_GET['commonpassword'];
		        $invalidusername=$_GET['invalidusername'];
		    
		  ?>
      
      
      			<!--message display-->
			<div class="container">
				<div class="text-center">
					<?php
		            			if($invalidusername)
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
      
      
			<!--Register form-->
			<form method="POST" action="register_details.php" class="jumbotron m-4">
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
            
            
					</body>


<?php include_once '../footer.php'; ?>
