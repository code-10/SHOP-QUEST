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
		                 			echo "<h5>Username shouldn't contain special characters</h5>";
		            			else if($commonpassword)
		                 			echo "<h5>Try Entering a secure password</h5>";
		            			else if($userexists)
		                			echo "<h5>User already exists</h5>";
		            			else if($emailexists)
		                			echo "<h5>Email is already registered</h5>";
		            			else if($error)
		                			echo "<h5>Something happened. try again</h5>";
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
