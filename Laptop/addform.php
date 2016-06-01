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
					<div class="col-md-11">						
						<h1>ป้อนรายการเครื่องเช่าใหม่</h1>
						
						<form class="form-horizontal" role="form">
					    <div class="form-group">
					      <label class="col-md-4">หมายเลขเครื่องเช่า:</label>
					      <div calss="col-md-4"><input type="text" class="form-control" name="nbCode" placeholder="CC-008">
					    </div>
					    <div class="form-group">
					      <label>ซีเรียลเครื่องเช่า:</label>
					      <input type="text" class="form-control" name="nbSerial" placeholder="PF07ZHKB">
					    </div>
					    <div class="form-group">
					      <label>ยี่ห้อ/รุ่น:</label>
					      <input type="text" class="form-control" name="nbSerial" placeholder="PF07ZHKB">
					       <input type="text" class="form-control" name="nbSerial" placeholder="PF07ZHKB">
					        <input type="text" class="form-control" name="nbSerial" placeholder="PF07ZHKB">
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