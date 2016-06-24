<?php
	require "../include/connect.php";
	
	$sql = $db->prepare("INSERT INTO notebook(nbCode,nbSerial,nbBrand,nbDetails,nbStatus) 
	      values(:nbCode,:nbSerial,:nbBrand,:nbDetails,:nbStatus)");
	$sql->execute(array(
		"nbCode" => $_POST["nbCode"],
		"nbSerial" => $_POST["nbSerial"],
		"nbBrand" => $_POST["nbBrand"],
		"nbDetails" => $_POST["nbDetails"],
		"nbStatus"=>$_POST["nbStatus"]
		));

	header('Location: index.php');
?>