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
        <title>สรุปข้อมูลตามช่วงเวลา</title>
		<?php include "../include/css.php"; ?>
		<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container" >
			<h1 style="margin-left:43px">สรุปข้อมูลตามช่วงเวลา</h1><br>
			<form role="form" class="form form-inline" action="" method="GET">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-6">	
						<div class="form-group">
					<label>ช่วงเวลา:</label>
					<input id="startdate" type="text" class="form-control" name="startdate">
					&nbsp;&nbsp;ถึง&nbsp;&nbsp;
					<input id="enddate" type="text" class="form-control" name="enddate">
						</div>		
					<br> <br><button type="submit" class="btn btn-warning">สรุปข้อมูลตามช่วงเวลา</button>	
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
				    $('#startdate,#enddate').datetimepicker({             
				        mask: true,
				        timepicker: true,
				        format: 'Y-m-d H:i',
				        value: d,
				        step: 1,
				    });	
			});
         </script> 

      <?php 
		$startdate=$_GET["startdate"];
		$enddate=$_GET["enddate"];
		$sql = $db->prepare("SELECT returnlap FROM rent WHERE (returnlap BETWEEN 
							(DATE_FORMAT('".$startdate."' ,'%Y-%m-%d %H:%i:00')) AND 
							(DATE_FORMAT('".$enddate."' ,'%Y-%m-%d %H:%i:00')))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		if ($row = $sql->fetch()) { ?> 
			<script type="text/javascript">
				$(document).ready(function () {
					var url = "dailyreport.php?startdate=<?=$startdate?>&enddate=<?=$enddate?>";
					window.open(url,'','height=900,width=1000');
					window.location = 'period.php';
				});
			</script>
		 <?php } ?>
    </body>
</html>