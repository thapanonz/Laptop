<?php
	require "../include/connect.php";
	
try{ 
	$sql = $db->prepare("INSERT INTO customer(Id,passport,prename,firstname,lastname,type,faculty,department,address,phone,email) values (:Id,:passport,:prename,:firstname,:lastname,:type,:faculty,:department,:address,:phone,:email)");
	$sql->execute(array(
		"Id" => $_POST["Id"],
		"passport" => $_POST["passport"],
		"prename" => $_POST["prename"],
		"firstname" => $_POST["firstname"],
		"lastname"=>$_POST["lastname"],
		"type" => $_POST["type"],
		"faculty" => $_POST["faculty"],
		"department" => $_POST["department"],
		"address" => $_POST["address"],
		"phone"=>$_POST["phone"],
		"email"=>$_POST["email"]
		));

	header('Location: index.php');
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>