<?php 

    session_start(); 
	  include_once '../libraries/chocolates.php';

	  $con=getCon();

	  $user=$_SESSION['user_name'];
    
    if(isset($_POST['submit_return_or_replace']))
    {
        $reason=$_POST['reason'];
        echo $reason;
    
    }
  
?>
