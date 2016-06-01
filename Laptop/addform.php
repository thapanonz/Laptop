<?php
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
        <title>Index -</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		
			<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-5">						
						<h1>ป้อนรายการเครื่องเช่าใหม่</h1>
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
					      <label>สถานะเครื่อง:</label>
					      <label class="radio-inline"><input type="radio" name="rdy">พร้อมใช้งาน</label>
						  <label class="radio-inline"><input type="radio" name="notrdy">ไม่พร้อมใช้งาน</label>
						  <label class="radio-inline"><input type="radio" name="rent">ถูกเช่า</label>
					    </div>					                    
					    <button type="submit" class="btn btn-success">บันทึก</button>
					    <button type="reset" class="btn btn-info">ยกเลิก</button>
					  </form>			
					</div>					
				</div>
			</div>
				

        <?php include "../include/js.php"; ?>      
    </body>
</html>