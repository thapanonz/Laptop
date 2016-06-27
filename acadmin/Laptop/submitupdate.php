<?php
	session_start();
	require "../include/connect.php";
try{
	$sql = "UPDATE notebook SET 
		nbCode =:nbCode,
		nbSerial = :nbSerial,
		nbBrand = :nbBrand,
		nbDetails = :nbDetails,
		nbStatus = :nbStatus 
		WHERE Id = :setID";
	$setid = $_POST['Id'];
	settype($setid, "integer");
	$stmp = $db->prepare($sql);
	$stmp->bindValue("nbCode" , $_POST["nbCode"]);
	$stmp->bindValue("nbSerial" , $_POST["nbSerial"]);
	$stmp->bindValue("nbBrand" , $_POST["nbBrand"]);
	$stmp->bindValue("nbDetails" , $_POST["nbDetails"]);
	$stmp->bindValue("nbStatus" , $_POST["nbStatus"]);
	$stmp->bindValue("setID" , $setid);
	$stmp->execute();
	// echo $_POST["Id"];

	// Log Statment
	require "../include/fnLogs.php";
	$menu = "Laptop";
	$desc = $_SESSION['userperm']." แก้ไขรายการโน๊ตบุ๊ที่ ".$_POST["nbCode"];
	logs($_SESSION['staffId'],$menu,$desc);
	
	header('Location: index.php');
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>