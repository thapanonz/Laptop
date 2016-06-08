<?php
	require "../include/connect.php";

try{
	$sql = "UPDATE customer SET 
		passport = :passport,
		prename = :prename,
		firstname = :firstname,
		lastname = :lastname,
		type = :type, 
		faculty = :faculty,
		department = :department,
		address = :address,
		phone = :phone,
		email = :email
		WHERE Id = :Id";
		
	$stmp = $db->prepare($sql);
	
	$stmp->bindValue("passport" , $_POST["passport"]);
	$stmp->bindValue("prename" , $_POST["prename"]);
	$stmp->bindValue("firstname" , $_POST["firstname"]);
	$stmp->bindValue("lastname" , $_POST["lastname"]);
	$stmp->bindValue("type" , $_POST["type"]);
	$stmp->bindValue("faculty" , $_POST["faculty"]);
	$stmp->bindValue("department" , $_POST["department"]);
	$stmp->bindValue("address" , $_POST["address"]);
	$stmp->bindValue("phone" , $_POST["phone"]);
	$stmp->bindValue("email" , $_POST["email"]);
	$stmp->bindValue("Id" , $_POST["Id"]);
	$stmp->execute();
	 // echo $_POST["Id"];

	header('Location: index.php');
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>