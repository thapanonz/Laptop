<?php
	session_start();
	require "../include/connect.php";
	
	$Id=$_GET['Id'];
	$sql = $db->exec("DELETE FROM notebook where Id=$Id");

	// Log Statment
	require "../include/fnLogs.php";
	$menu = "Laptop";
	$desc = $_SESSION['userperm']." ลบรายการโน๊ตบุ๊คที่ (".$_GET['Id'].")";
	logs($_SESSION['staffId'],$menu,$desc);
	
    header('Location: index.php');
?> 