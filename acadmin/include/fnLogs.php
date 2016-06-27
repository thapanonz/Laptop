<?php
function logs($staffid,$menu,$desc){
		require "connect.php";
		$sql = "INSERT INTO logs(";
		$sql .= "staffId,menu,description";
		$sql .= ") VALUES(";
		$sql .= ":staffId,";
		$sql .= ":menu,";
		$sql .= ":desc)";
		$qry = $db->prepare($sql);
		$qry->execute(array(
		"staffId" => $staffid,
		"menu" => $menu,
		"desc" => $desc
		));
	}
?>