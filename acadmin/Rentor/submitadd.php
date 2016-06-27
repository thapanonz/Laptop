<?php
	session_start();
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

	require "../include/fnLogs.php";
	$menu = "Rentor";
	$desc = $_SESSION['userperm']." เพิ่มรายการผู้เช่าชื่อ ".$_POST["prename"].$_POST["firstname"]." ".$_POST["lastname"];
	logs($_SESSION['staffId'],$menu,$desc);

	header('Location: index.php');
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>