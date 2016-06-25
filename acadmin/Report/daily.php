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
			<form role="form" action="submitadd.php" method="post">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-4">	
						<div class="form-group">
					<label>วันที่คืน:</label>
					<input required id="rentdate" type="text" class="form-control" name="returnlap">	    
					    </div>		
				<a href='' class="btn btn-warning btnsubmit">สรุปข้อมูลรายวัน</a>
				</div>	  
			</form>		
			</div>
						

        <?php include "../include/js.php"; ?>      
         <script src="../js/jquery.datetimepicker.full.min.js"></script> 
         <script type="text/javascript">
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
         <script type="text/javascript">
         	$(".btnsubmit").click(function(){
				var url = "dailyreport.php?returnlap=".$row['Id'].";
				window.open(url,'','height=900,width=1000');
				window.location = 'index.php';
				});	
		</script>
    </body>
</html>