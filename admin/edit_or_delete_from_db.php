<?php
        include_once '../header.php';
        session_start();
        include '../libraries/chocolates.php';
        $category=Array();
        $con = getCon();  
       
        /*if(!(isset($_SESSION['user_name']))||($_SESSION['user_name']!="root"))
      	{
            header("Location:../index.php");
            die(); 
      	} */


        
        
        
?>

<?php

	$edit_delete_product_id=$_POST['edit_delete_product_id'];
	$edit_delete_unique_type_id=$_POST['edit_delete_unique_type_id'];

	if(isset($_POST['edit_info_p']))
	{
		
	}
	else if(isset($_POST['edit_info_u']))
	{
		
	}
	else if(isset($_POST['delete_info_p']))
	{
		$con->query("delete from unique_product where product_id='$edit_delete_product_id'");
		$con->query("delete from products where product_id='$edit_delete_product_id'");
                header("Location:check_db.php");
	}
	else if(isset($_POST['delete_info_u']))
	{
		$con->query("delete from unique_product where unique_type_id='$edit_delete_unique_type_id'");
                header("Location:check_db.php");
	}

?>




