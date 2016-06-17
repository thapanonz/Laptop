<?php
	require "../include/connect.php";
	
try{ 

	 
	 $sql = "INSERT INTO rent(citizenId,laptopId,rentlap,appointlap,staffId) 
 	VALUES (:citizenId,:setlaptopId,:rentlap,:appointlap,:setstaffId)";
	
	$setlaptopId = $_POST['laptopId'];
	settype($setlaptopId, "integer");
	$setstaffId = $_POST['staffId'];
	settype($setstaffId, "integer");
	
	$stmp = $db->prepare($sql);
	$stmp->bindValue("citizenId" , $_POST["citizenId"]);
	$stmp->bindValue("setlaptopId" , $setlaptopId);
	$stmp->bindValue("rentlap" , $_POST["rentlap"]);
	$stmp->bindValue("appointlap" , $_POST["appointlap"]);
	$stmp->bindValue("setstaffId" , $setstaffId);
	
	if ($stmp->execute()) {
		$sql = "UPDATE notebook SET nbStatus='rent' WHERE Id=:setlaptopId";

		$setlaptopId = $_POST['laptopId'];
		settype($setlaptopId, "integer");

		$stmp = $db->prepare($sql);
		$stmp->bindValue("setlaptopId" , $setlaptopId);
		$stmp->execute(); ?>

		<script> window.open('report.php','_blank'); </script>
	<?php } 

	  // print_r($stmp->errorInfo());  

	header('Location: index.php');
}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>