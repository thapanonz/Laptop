<?php
	session_start();
	require "../include/connect.php";
	
	$Id=$_GET['Id'];
	$sql1 = $db->prepare("SELECT nbCode FROM notebook WHERE Id=".$Id);
	$sql1->execute();
	$sql1->setFetchMode(PDO::FETCH_ASSOC);
	if ($row1 = $sql1->fetch()) {
		require "../include/fnLogs.php";
		$menu = "Permission";
		$desc = $_SESSION['userperm']." ลบรายการเครื่องเช่าหมายเลข ".$row1["nbCode"];
		logs($_SESSION['staffId'],$menu,$desc);
	
	$sql = $db->exec("DELETE FROM notebook where Id=$Id");
    header('Location: index.php');
	}
?> 