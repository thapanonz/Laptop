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
		$stmp->execute(); 
		
		$maxSQL = "SELECT Id FROM rent ORDER By Id Desc LIMIT 1";
		$maxSTM = $db->prepare($maxSQL);
		$maxSTM->execute();
		$maxSTM->setFetchMode(PDO::FETCH_ASSOC);
		if($row = $maxSTM->fetch())
		{

		 ?>
			<script type="text/javascript">
				var url = "agreement.php?Id=<?=$row['Id']?>";
				window.open(url,'','height=900,width=1000');
				window.location = 'index.php';
			</script>
		 <?
		}
		?>

<?php } 

	  // print_r($stmp->errorInfo());  

}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>