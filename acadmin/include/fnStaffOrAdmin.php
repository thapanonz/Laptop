<?php

function add($id,$staffUser,$name,$lastname){
		require "connect.php";

		$sql = "INSERT INTO stafforadmin(";
		$sql .= "id,staffUser,name,lastname";
		$sql .= ") VALUES(";
		$sql .= ":id,";
		$sql .= ":staffUser,";
		$sql .= ":name,";
		$sql .= ":lastname)";

		$qry = $db->prepare($sql);

		$qry->execute(array(
		"id" => $id,
		"staffUser" => $staffUser,
		"name" => $name,
		"lastname" => $lastname
		));
	}

function isExist($id,$staffUser) {
		require "connect.php";
		
		$sql = "SELECT count(id) FROM stafforadmin ";
		$sql .= "WHERE id = :id ";
		$sql .= "AND staffUser = :staffUser ";

		$qry = $db->prepare($sql);
		
		$qry->execute(array(
		"id" => $id,
		"staffUser" => $staffUser
		));
		
		//$CountId = "NULL";
		$qry->setFetchMode(PDO::FETCH_ASSOC);
		
		if ($row = $qry->fetch()) {
			$CountId = $row["count(id)"];		
		}
		
		if($CountId == 0) 
			{ return 0; }
		else 
			{ return 1; }
	}

?>