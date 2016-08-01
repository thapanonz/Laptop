<?php
		session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
	require "../include/connect.php";
	require "../include/functions.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "periodreport";

	function DateThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear $strHour:$strMinute";
	}

	function DateThai1($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
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

		<div class="container">			
			<form role="form" class="form form-inline" action="" method="GET">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-6">	
					<h1 style="margin-left:43px">สรุปข้อมูลตามช่วงเวลา</h1><br>
						<div class="form-group">
					<label>ช่วงเวลา:</label>
					<input id="startdate" type="text" class="form-control" name="startdate">
					&nbsp;&nbsp;ถึง&nbsp;&nbsp;
					<input id="enddate" type="text" class="form-control" name="enddate">
						</div>		
					<br> <br><button type="submit" class="btn btn-warning">สรุปข้อมูลตามช่วงเวลา</button>	
					</div> 				
			</form>		

			<form role="form" class="form form-inline" action="" method="GET">				
					<div class="col-xs-6">	
					<h1 style="margin-left:43px">สรุปข้อมูลรายเดือน</h1><br>
						<div class="form-group">
					<label>วันที่:</label>
					<input id="startdate1" type="text" class="form-control" name="startdate1">
					&nbsp;&nbsp;ถึง&nbsp;&nbsp;
					<input id="enddate1" type="text" class="form-control" name="enddate1">
						</div>		
					<br> <br><button type="submit" class="btn btn-warning">สรุปข้อมูลรายเดือน <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>	
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

				    $('#startdate1,#enddate1').datetimepicker({             
				        mask: true,
				        timepicker: true,
				        format: 'Y-m-d',
				        value: d,
				        step: 1,
				    });	
			});
         </script> 

      <?php 
       if (isset($_GET["startdate"]) && isset($_GET["enddate"])) {
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
		<?php } 
		 else if(isset($_GET["startdate"]) && isset($_GET["enddate"])) { ?>
		 	<script type="text/javascript">
		 	alert("ไม่พบรายละเอียดการรับคืนตามช่วงเวลา\nวันที่ "+<?php echo "\"".DateThai($startdate)." ถึง ".DateThai($enddate)."\"" ?>);
		 	</script>
		 	<?php } } 	


	    if (isset($_GET["startdate1"]) && isset($_GET["enddate1"])) {
	    $startdate1=$_GET["startdate1"];
		$enddate1=$_GET["enddate1"];
		
		$sql = $db->prepare("SELECT returnlap FROM rent WHERE (returnlap BETWEEN 
							(DATE_FORMAT('".$startdate1."' ,'%Y-%m-%d 00:00:00')) AND 
							(DATE_FORMAT('".$enddate1."' ,'%Y-%m-%d 23:59:00')))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		if ($row = $sql->fetch()) { ?>
			<script type="text/javascript">
				$(document).ready(function () {					
				window.open("monthreport.php?startdate1=<?=$startdate1?>&enddate1=<?=$enddate1?>");	
				window.location = 'period.php'; });
			</script> 
		<?php } 
		 else if(isset($_GET["startdate1"]) && isset($_GET["enddate1"])) { ?>
		 	<script type="text/javascript">
		 	alert("ไม่พบรายละเอียดการรับคืนตามช่วงเวลา\nวันที่ "+<?php echo "\"".DateThai1($startdate1)." ถึง ".DateThai1($enddate1)."\"" ?>);
		 	</script>
		 	<?php } } ?>
    </body>
</html>