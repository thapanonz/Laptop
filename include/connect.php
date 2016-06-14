<?php
	$HOST_NAME = "127.0.0.1";
<<<<<<< HEAD
	$DB_NAME = "laptop";
=======
	$DB_NAME = "proj_notebook";
>>>>>>> Thapanon
	$CHAR_SET = "charset=utf8"; 
	$USERNAME = "acadmin";     
	$PASSWORD = "zxc123**";  
 
	try {
		$db = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
	} catch (PDOException $e) {
		echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
	}
?>