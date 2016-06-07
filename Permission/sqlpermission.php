<?php
	require "../include/connect.php";
	
	$sql = $db->prepare("INSERT INTO permission (user,pname,name,lastname,level,last_login) 
		VALUES (:user,:pname,:name,:lastname,:level,NOW());");
	$sql->execute(array(
		"user" => $_POST["user"],
		"pname" => $_POST["pname"],
		"name" => $_POST["name"],
		"lastname" => $_POST["lastname"],
		"level" => $_POST["level"],
		));

	header('Location: index.php');
?>