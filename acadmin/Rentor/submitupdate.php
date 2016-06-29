<?php
	session_start();
	require "../include/connect.php";
	// echo "<pre>";
	// print_r(var_dump($_POST));
	// echo "</pre>";

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
		email = :email,
		isBlacklist = :setisBlacklist
		WHERE Id = :Id";
		
	$setisBlacklist = $_POST['isBlacklist'];
	settype($setisBlacklist, "integer");

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
	$stmp->bindValue("setisBlacklist" , $setisBlacklist);
	$stmp->bindValue("Id" , $_POST["Id"]);
	if($stmp->execute()) {

		require "../include/fnLogs.php";
		$menu = "Rentor";
		$desc = $_SESSION['userperm']." แก้ไขข้อมูลผู้เช่าเลขบัตร ".$_POST["Id"];
		logs($_SESSION['staffId'],$menu,$desc);
	 
	header('Location: index.php');
		}
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>