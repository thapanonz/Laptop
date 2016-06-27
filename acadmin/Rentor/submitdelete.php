<?php
	session_start();
	require "../include/connect.php";

	$sql = ("DELETE FROM customer where Id LIKE :Id");
	$stmt = $db->prepare($sql);
	$stmt->bindParam('Id', $_GET['Id'], PDO::PARAM_STR);
	if($stmt->execute()) {

	require "../include/fnLogs.php";
	$menu = "Rentor";
	$desc = $_SESSION['userperm']." ลบรายการผู้เช่า";
	logs($_SESSION['staffId'],$menu,$desc);

    header('Location: index.php');
	}
?> 

