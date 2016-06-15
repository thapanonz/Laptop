<?php
	require "../include/connect.php";

// echo "<pre>";
// echo var_dump($_POST); 
// echo "</pre>";

try{
	$sql = "UPDATE rent SET 
		laptopId = :setlaptopId,
		rentlap = :rentlap,
		appointlap = :appointlap,
		staffId = :setstaffId";
			
			if(isset($_POST['returnlap']))
			{
				$sql .= ", returnlap = :returnlap";
				$sql .= ", isLate = :setisLate";
				$sql .= ", cost = :setcost";
				$sql .= ", returnstaffId = :setreturnstaffId";
			}

	$sql .= " WHERE Id = :setId";
	

	$setlaptopId = $_POST['laptopId'];
	settype($setlaptopId, "integer");
	$setstaffId = $_POST['staffId'];
	settype($setstaffId, "integer");
	$setId = $_POST['Id'];
	settype($setId, "integer");
	
			if(isset($_POST['returnlap']))
			{
				$setisLate = $_POST['isLate'];
				settype($setisLate, "integer");
				$setcost = $_POST['fee'];
				settype($setcost, "integer");
				$setreturnstaffId = $_POST['returnstaffId'];
				settype($setreturnstaffId, "integer");
			}


	$stmp = $db->prepare($sql);	
	$stmp->bindValue("setlaptopId" , $setlaptopId);
	$stmp->bindValue("rentlap" , $_POST["rentlap"]);
	$stmp->bindValue("appointlap" , $_POST["appointlap"]);
	$stmp->bindValue("setstaffId" , $setstaffId);
	$stmp->bindValue("setId" , $setId);
	
			if(isset($_POST['returnlap']))
			{
				$stmp->bindValue("returnlap" , $_POST["returnlap"]);
				$stmp->bindValue("setisLate" , $setisLate);
				$stmp->bindValue("setcost" , $setcost);
				$stmp->bindValue("setreturnstaffId" , $setreturnstaffId);
			}

	$stmp->execute();
	
	header('Location: index.php');
	}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>