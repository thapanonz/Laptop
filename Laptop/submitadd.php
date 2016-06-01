<?php
	require "../include/connect.php";
	
	$sql = $db->prepare("INSERT INTO notebook(nbCode,nbSerial,nbBrand,nbDetails) 
	      values(:nbCode,:nbSerial,:nbBrand,:nbDetails)");
	$sql->execute(array(
		"nbCode" => $_POST["nbCode"],
		"nbSerial" => $_POST["nbSerial"],
		"nbBrand" => $_POST["nbBrand"],
		"nbDetails" => $_POST["nbDetails"]
		));
	header('Location: index.php');
?>