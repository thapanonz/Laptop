<?php
	session_start();
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
	if($stmp->execute()){
		$sql1 = $db->prepare("SELECT user FROM permission WHERE Id=".$setid);
		$sql1->execute();
		$sql1->setFetchMode(PDO::FETCH_ASSOC);
		if ($row1 = $sql1->fetch()) {
			require "../include/fnLogs.php";
			$menu = "Permission";
			$desc = $_SESSION['userperm']." แก้ไขข้อมูลผู้ใช้งานชื่อ ".$row1["user"];
			logs($_SESSION['staffId'],$menu,$desc);

			header('Location: index.php');
		}
	 }
}
catch(PDOException $e) {
  echo $e->getMessage();
} ?>