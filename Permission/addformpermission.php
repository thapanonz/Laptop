<?php
	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "permission";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>เพิ่มผู้จัดการสิทธิ์</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body style="background-color:lightgrey;">
		<?php include "../include/banner.php"; ?>

		
			<?php include "../include/menu.php"; ?>	
		
		
			<div class="container">
				<div class="row">
					<div class="col-xs-4" style="margin-left: 30px">
					
						<h1>เพิ่มผู้จัดการสิทธิ์</h1><br>

						<?php $rdo="" ?>

						<form role = "form" action="sqlpermission.php" method="post">
												
						<div class="form-group">
							<h4>ชื่อผู้ใช้</h4>
							<input type="text" class="form-control" name="user"><br>
						</div>
						<div class="form-grop">
							<h4>คำนำหน้าชื่อ</h4>
							<input type="text" name="pname" class="form-control"><br>
						</div>
						<div class="form-group">
							<h4>ชื่อ</h4>
							<input type="text" class="form-control" name="name"><br>
						</div>
						<div class="form-group">
							<h4>นามสกุล</h4>
							<input type="text" class="form-control" name="lastname"><br>
						</div>
						
						
						
						<div class="form-group">
							<h4>ประเภทผู้ใช้</h4>
							<input type="radio" name="level" value="admin"> ผู้ดูแล
							<input type="radio" name="level" value="sadmin"> เจ้าหน้าที่<br><br>
						</div>
						<div class="form-group">
						<div style="text-align:center">
							<button type="submit" class="btn btn-success">ตกลง</button>
							<button type="reset" class="btn btn-primary">ยกเลิก</button>
						</div>
						</div>
						</form>
						
					</div>	
				</div>
			</div>
		
				
				
			
		
        <?php include "../include/js.php"; ?>      
    </body>
</html>