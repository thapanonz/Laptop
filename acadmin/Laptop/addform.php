<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "laptop";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ป้อนรายการเครื่องเช่าใหม่</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">				
					<div class="col-xs-5" style="margin-left: 30px">						
						<h1>ป้อนรายการเครื่องเช่าใหม่</h1><br>
						<form role="form" action="submitadd.php" method="post">
					    <div class="form-group">
					      <label>หมายเลขเครื่องเช่า:</label>
					      <input type="text" class="form-control" name="nbCode" placeholder="ตัวอย่าง: CC-000"> 
					    </div>
					    <div class="form-group">
					      <label>ซีเรียลเครื่องเช่า:</label>
					      <input type="text" class="form-control" name="nbSerial" placeholder="ตัวอย่าง: PF07ZHKB">
					    </div>
					    <div class="form-group">
					      <label>ยี่ห้อ/รุ่น:</label>
					      <input type="text" class="form-control" name="nbBrand" 
					      placeholder="ตัวอย่าง: Lenovo G40-80 (80E4)"></div>
					    <div class="form-group">
					      <label>รายละเอียดของเครื่อง:</label>
					      <textarea class="form-control" name="nbDetails" rows="5"
					      placeholder="ตัวอย่าง: Intel Core i7-5500U, RAM: 8GB, HarddiskDrive: 1TB,    Optical Drive: DVD RW, Display: 14 HD LED, Battery: 4 Cell"></textarea>
					    </div>
					    <div class="form-group">
					      <label>สถานะเครื่อง: &nbsp;&nbsp;&nbsp;</label>
					      <label class="radio-inline"><input type="radio" name="nbStatus" value="rdy">พร้อมใช้งาน</label>
						  <label class="radio-inline"><input type="radio" name="nbStatus" value="notrdy">ไม่พร้อมใช้งาน</label>
						  <label class="radio-inline"><input type="radio" name="nbStatus" value="rent">ถูกเช่า</label>
					    </div>	
					   <div style="text-align: center">
						    <button type="submit" class="btn btn-success">บันทึก</button>				   <a href="index.php" class="btn btn-primary">ยกเลิก</a>
					   </div>		   
					    </form>			
					</div>					
			</div>
        <?php include "../include/js.php"; ?>      
    </body>
</html>