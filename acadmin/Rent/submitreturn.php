<?php
	session_start();
	require "../include/connect.php";
	
try{ 
	 $sql = "UPDATE rent SET 
	 returnlap = :returnlap,
	 isLate = :setisLate,
	 cost = :setcost,
	 returnstaffId = :setreturnstaffId,
	 isFine = :setisFine
	 WHERE Id=:setId";
	
	$setisLate = $_POST['isLate'];
	settype($setisLate, "integer");	
	$setcost = $_POST['fee'];
	settype($setcost, "integer");
	$setreturnstaffId = $_POST['returnstaffId'];
	settype($setreturnstaffId, "integer");
	$setisFine = $_POST['isFine'];
	settype($setisFine, "integer");
	$setId = $_POST['Id'];
	settype($setId,"integer");
	
	$stmp = $db->prepare($sql);
	$stmp->bindValue("returnlap" , $_POST["returnlap"]);
	$stmp->bindValue("setisLate" , $setisLate);
	$stmp->bindValue("setcost" , $setcost);
	$stmp->bindValue("setisFine" , $setisFine);
	$stmp->bindValue("setreturnstaffId" , $setreturnstaffId);
	$stmp->bindValue("setId" , $setId);
	
	if($stmp->execute()) {
		require "../include/fnLogs.php";
		$menu = "Rent";
		$desc = $_SESSION['userperm']." คืนเครื่องสัญญาเช่าเลขที่ ".$setId;
		logs($_SESSION['staffId'],$menu,$desc); 
	?>

		<script type="text/javascript">
				var url = "receipt.php?Id=<?=$setId?>";
				window.open(url,'','height=900,width=1000');
				window.location = 'index.php';
		</script>
	<?php } 
	//header('Location: index.php');
}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>