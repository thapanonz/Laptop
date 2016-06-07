<?php
	require "../include/connect.php";
try{
	$sql = "UPDATE permission SET
		level = :level
		WHERE Id = :setID";
	$setid = $_POST['Id'];
	settype($setid, "integer");
	$stmp = $db->prepare($sql);
	$stmp->bindValue("level" , $_POST["level"]);
	$stmp->bindValue("setID" , $setid);
	$stmp->execute();
	echo $_POST["Id"];
	header('Location: index.php');
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>