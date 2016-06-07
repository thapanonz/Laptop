<?php
	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "listalluser";

	function setstatus($status){
		if($status=="rdy"){ return "พร้อมใช้งาน";}
		else if($status=="notrdy"){ return "ไม่พร้อมใช้งาน";}
		else if($status=="rent"){ return "ถูกเช่า";}
	}	
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>รายการผู้เช่าทั้งหมด</title>
		<?php include "../include/css.php"; ?>
		
		<style type="text/css">
			th {text-align: center;}
		</style>		
    </head>
    <body>
		<?php include "../include/banner.php"; ?>
		
			<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-4" style="margin-left: 30px">						
						<h1>รายการผู้เช่า</h1>
						<a href="addform.php" class="btn btn-primary">เพิ่มรายการ</a>
		
		</div>					
	</div>
</div>
						
        <?php include "../include/js.php"; ?>     
    </body>
</html>


