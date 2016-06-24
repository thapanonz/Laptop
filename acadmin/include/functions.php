<?php 
	function getNewID() {
		require "connect.php";

		$sql = $db->prepare("SELECT max(Id) FROM rent");		
		$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			if ($row = $sql->fetch()) {
				$MaxId=$row["max(Id)"];
			}

			if($MaxId=="NULL") { return 1; }
			else { return $MaxId+1; }
	}
?>
