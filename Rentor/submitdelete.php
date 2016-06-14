<?php
	require "../include/connect.php";
	

	$sql = ("DELETE FROM customer where Id LIKE :Id");
	$stmt = $db->prepare($sql);
	$stmt->bindParam('Id', $_GET['Id'], PDO::PARAM_STR);
	$stmt->execute();

	//print_r($db->errorInfo());

    header('Location: index.php');
?> 

