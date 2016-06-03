<?php
	require "../include/connect.php";
	
	$sql = $db->prepare("INSERT INTO permission (user,level,last_login) 
		VALUES (:user,:level,NOW());");
	$sql->execute(array(
		"user" => $_POST["user"],
		"level" => $_POST["level"],
		));

	header('Location: index.php');
?>