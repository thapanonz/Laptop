<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	if($_SESSION['userlevel'] != "sadmin") {
	header('Location: ../login.php?error=3'); 
	}
	
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
        <title>เพิ่มสิทธิ์ผู้ใช้งาน</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body style="background-color:lightgrey;">
		<?php include "../include/banner.php"; ?>

		
			<?php include "../include/menu.php"; ?>	
		
		
			<div class="container">
				<div class="row">
					<div class="col-xs-4" style="margin-left: 30px">				
						<h1>เพิ่มสิทธิ์ผู้ใช้งาน</h1><br>
						<form role = "form" action="sqlpermission.php" method="post">							
						<div class="form-group">
							<label>ชื่อผู้ใช้:</label>
							<input type="text" class="form-control" name="user">
						</div>
						<div class="form-grop">
							<label>คำนำหน้าชื่อ:</label>
							<input type="text" name="pname" class="form-control">
						</div>
						<div class="form-group">
							<label>ชื่อ:</label>
							<input type="text" class="form-control" name="name">
						</div>
						<div class="form-group">
							<label>นามสกุล:</label>
							<input type="text" class="form-control" name="lastname">
						</div>										
						<div class="form-group">
					      <label>ประเภทผู้ใช้</label><br>
					      <label class="radio-inline" style="margin-left: 30px;"><input type="radio" name="level"value="sadmin">ผู้ดูแล</label>
						  <label class="radio-inline"><input type="radio" name="level" value="admin">เจ้าหน้าที่</label>						 
					    </div>	
						<div class="form-group">
						<div style="text-align:center">
							<button type="submit" class="btn btn-success">ตกลง</button>
							<a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
						</div>
						</form>
						
					</div>	
				</div>
			</div>
			
        <?php include "../include/js.php"; ?>      
    </body>
</html>