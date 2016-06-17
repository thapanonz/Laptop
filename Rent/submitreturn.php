<?php
	require "../include/connect.php";
	
try{ 
	 $sql = "UPDATE rent SET 
	 returnlap = :returnlap,
	 isLate = :setisLate,
	 cost = :setcost,
	 isLate = :setisLate,
	 returnstaffId = :setreturnstaffId
	 WHERE Id=:setId";
	
	$setisLate = $_POST['isLate'];
	settype($setisLate, "integer");
	$setisFine = $_POST['isFine'];
	settype($setisFine, "integer");
	$setcost = $_POST['fee'];
	settype($setcost, "integer");
	$setreturnstaffId = $_POST['returnstaffId'];
	settype($setreturnstaffId, "integer");
	$setId = $_POST['Id'];
	settype($setId,"integer");
	
	$stmp = $db->prepare($sql);
	$stmp->bindValue("returnlap" , $_POST["returnlap"]);
	$stmp->bindValue("setisLate" , $setisLate);
	$stmp->bindValue("setcost" , $setcost);
	$stmp->bindValue("setisFine" , $setisFine);
	$stmp->bindValue("setreturnstaffId" , $setreturnstaffId);
	$stmp->bindValue("setId" , $setId);
	
	$stmp->execute();

	//print_r($stmp->errorInfo());
	header('Location: index.php');
}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>