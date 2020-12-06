<?php include_once '../header.php'; ?>

<?php

    session_start();
    include '../libraries/chocolates.php';
    $cat_id = $_GET['cat_id']; 
    $cat_name = $_GET['cat_name']; 
  
    $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;
  
?>



<?php include_once '../footer.php'; ?>
