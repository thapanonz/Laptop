<?php
	session_start();
	require "../include/connect.php";

	$sql1 = $db->prepare("SELECT prename,firstname,lastname FROM customer WHERE Id='".$_GET['Id']."'");
	$sql1->execute();
	$sql1->setFetchMode(PDO::FETCH_ASSOC);
	if ($row1 = $sql1->fetch()) { 
		require "../include/fnLogs.php";
		$menu = "Rentor";
		$desc = $_SESSION['userperm']." ลบรายการผู้เช่าชื่อ ".$row1["prename"].$row1["firstname"]." ".$row1["lastname"];
		logs($_SESSION['staffId'],$menu,$desc);
	
	$sql = ("DELETE FROM customer where Id LIKE :Id");
	$stmt = $db->prepare($sql);
	$stmt->bindParam('Id', $_GET['Id'], PDO::PARAM_STR);
	$stmt->execute();

    header('Location: index.php');
	}
?> 

