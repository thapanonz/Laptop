<?php
		session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
	require "../include/connect.php";
	require "../include/functions.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "dailyreport";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>สรุปข้อมูลรายวัน</title>
		<?php include "../include/css.php"; ?>
		<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container" >
			<h1 style="margin-left:43px">สรุปข้อมูลรายวัน</h1><br>
			<form role="form" action="" method="GET">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-3">	
						<div class="form-group">
					<label>วันที่คืน:</label>
					<input id="rentdate" type="text" class="form-control" name="returnlap">	    
					    </div>		
					    <button type="submit" class="btn btn-warning">สรุปข้อมูลรายวัน</button>
				
					</div> 
				</div>  
			</form>		
			</div>
			

        <?php include "../include/js.php"; ?>      
         <script src="../js/jquery.datetimepicker.full.min.js"></script> 
         <script>
         	$(document).ready(function () {
				    var d = new Date();
				    $.datetimepicker.setLocale('th');
				    $('#rentdate').datetimepicker({             
				        mask: true,
				        timepicker: true,
				        format: 'Y-m-d',
				        value: d,
				        step: 1,
				    });	
			});
         </script> 

      <?php 
      	isset($_GET["returnlap"])? $returnlap=$_GET["returnlap"] : $returnlap="";	
		$sql = $db->prepare("SELECT returnlap FROM rent WHERE (returnlap BETWEEN 
							(DATE_FORMAT(DATE_SUB('".$returnlap."',INTERVAL 1 DAY) ,'%Y-%m-%d 13:00:00')) AND 
							(DATE_FORMAT('".$returnlap."','%Y-%m-%d 12:59:00')))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		if ($row = $sql->fetch()) { ?> 
			<script type="text/javascript">
				$(document).ready(function () {
					var url = "dailyreport.php?returnlap=<?=$returnlap?>";
					window.open(url,'','height=900,width=1000');
					window.location = 'daily.php';
				});
			</script>
		 <?php } ?>
    </body>
</html>