<?php
	require "include/connect.php";

	$user=$_POST["username"];
	$sql = $db->prepare("SELECT user FROM permission WHERE user='".$user."'");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	if ($row = $sql->fetch()) { 
		echo "login Success"; }
	else {
		header('Location: login.php?error=1');		
	}
?>