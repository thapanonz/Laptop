<?php
	session_start();
	require "include/connect.php";

	$user=$_POST["username"];
	$sql = $db->prepare("SELECT Id,user,level FROM permission WHERE user='".$user."'");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	if ($row = $sql->fetch()) { 
		$sql1= "UPDATE permission SET last_login = NOW() WHERE user = :user";
		$stmp = $db->prepare($sql1);
		$stmp->bindParam("user" , $_POST["username"]);
		if ($stmp->execute()) {
			$_SESSION['staffId'] = $row['Id'];
			$_SESSION['userperm'] = $user;
			$_SESSION['userlevel'] = $row['level'];

			// Log Statment
			$menu = "Login";
			$desc = $_SESSION['userperm']." เข้าสู่ระบบ";
			logs($_SESSION['staffId'],$menu,$desc);


			session_write_close();
			header('Location: index.php'); 
		}
	}
	else {
		header('Location: login.php?error=1');		
	}
?>


