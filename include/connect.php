<?php
	$HOST_NAME = "127.0.0.1";
	$DB_NAME = "Proj_Notebook";
	$CHAR_SET = "charset=utf8"; 
	$USERNAME = "paiboon";     
	$PASSWORD = "123";  
 
	try {
		$db = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
	} catch (PDOException $e) {
		echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
	}
?>