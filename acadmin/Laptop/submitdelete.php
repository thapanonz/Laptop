<?php
	session_start();
	require "../include/connect.php";
	
	$Id=$_GET['Id'];
	$sql = $db->exec("DELETE FROM notebook where Id=$Id");
	// Log Statment
	$menu = "Laptop";
	$desc = $_SESSION['userperm']." ลบรายการโน๊ตบุ๊ค";
	logs($_SESSION['staffId'],$menu,$desc);
    header('Location: index.php');
?> 