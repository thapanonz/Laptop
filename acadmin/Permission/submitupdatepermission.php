<?php
	require "../include/connect.php";
try{
	$sql = "UPDATE permission SET
		pname = :pname,
		name = :name,
		lastname = :lastname,
		level = :level
		WHERE Id = :setID";
	$setid = $_POST['Id'];
	settype($setid, "integer");
	$stmp = $db->prepare($sql);
	$stmp->bindValue("pname" , $_POST["pname"]);
	$stmp->bindValue("name" , $_POST["name"]);
	$stmp->bindValue("lastname" , $_POST["lastname"]);
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