<?php
	require "../include/connect.php";
	
	$Id=$_GET['Id'];
	$sql = $db->exec("DELETE FROM permission where Id=$Id");
       	    
    header('Location: index.php');
?>
