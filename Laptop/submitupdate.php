<?php
	require "../include/connect.php";
	
	$sql = $db->prepare("UPDATE notebook SET nbCode=:nbCode,nbSerial=:nbSerial,nbBrand=:nbBrand,
		nbDetails=:nbDetails,nbStatus=:nbStatus WHERE Id=:Id");
	$sql->execute(array(
		"Id" => $_POST["Id"],
		"nbCode" => $_POST["nbCode"],
		"nbSerial" => $_POST["nbSerial"],
		"nbBrand" => $_POST["nbBrand"],
		"nbDetails" => $_POST["nbDetails"],
		"nbStatus"=>$_POST["nbStatus"]
		));

	header('Location: index.php');
?>