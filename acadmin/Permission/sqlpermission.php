<?php
	session_start();
	require "../include/connect.php";

try {
	$sql = $db->prepare("INSERT INTO permission (user,pname,name,lastname,level,last_login) 
		VALUES (:user,:pname,:name,:lastname,:level,NOW());");
	$sql->execute(array(
		"user" => $_POST["user"],
		"pname" => $_POST["pname"],
		"name" => $_POST["name"],
		"lastname" => $_POST["lastname"],
		"level" => $_POST["level"],
		)); 

	require "../include/fnLogs.php";
	$menu = "Permission";
	$desc = $_SESSION['userperm']." เพิ่มสิทธิ์ผู้ใช้งานชื่อ ".$_POST["user"];
	logs($_SESSION['staffId'],$menu,$desc);

	header('Location: index.php');
}
catch(PDOException $e) {
  echo $e->getMessage();
}	
?>