<?php
	session_start();
	require "../include/connect.php";
	 

	$sql = $db->prepare("INSERT INTO rent (citizenId,laptopId,rentlap,appointlap,staffId) 
 	VALUES (:citizenId,:setlaptopId,:rentlap,:appointlap,:setstaffId)");
	
	$setlaptopId = $_POST['laptopId'];
	settype($setlaptopId, "integer");
	$setstaffId = $_POST['staffId'];
	settype($setstaffId, "integer");
	echo "Before Execute";
	$sql->execute(array(
		"citizenId" => $_POST["citizenId"],
		"setlaptopId" => $setlaptopId,
		"rentlap" => $_POST["rentlap"],
		"appointlap" => $_POST["appointlap"],
		"setstaffId" => $setstaffId,
		));

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
			require "../include/fnLogs.php";
			$menu = "Rent";
			$desc = $_SESSION['userperm']." เพิ่มสัญญาเช่าเลขที่ ".$row["Id"];
			logs($_SESSION['staffId'],$menu,$desc);

		 ?>
			<script type="text/javascript">
				 var url = "agreement.php?Id=<?=$row['Id']?>";
				 window.open(url,'','height=900,width=1000');
			     window.location = 'index.php';
			</script>
		 <?php
		}
	

	  // print_r($stmp->errorInfo());  
?>