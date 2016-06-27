<?php
	session_start();
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

	// Log Statment
	require "../include/fnLogs.php";
	$menu = "Laptop";
	$desc = $_SESSION['userperm']." เพิ่มรายการโน๊ตบุ๊ที่ ".$_POST["nbCode"];
	logs($_SESSION['staffId'],$menu,$desc);
	
	header('Location: index.php');
?>