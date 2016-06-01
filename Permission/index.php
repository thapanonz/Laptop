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
        <title>Index -</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		
			<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-5">						
						<h1>จัดการสิทธิ์</h1><br>
						
						<h3>ชื่อผู้ใช้</h3>
						<input type="text" name="username"><br><br>
						
						<h3>ประเภทผู้ใช้</h3>
						<input type="radio" name="usertype" value="student"> นักศึกษา
						<input type="radio" name="usertype" value="personnel"> บุคลากร<br><br>
						
						<h3>เวลาใช้งานล่าสุด</h3>
						<input type="datetime-local" name="daytime">


					</div>
					
				</div>
			</div>
				
				
			
		
        <?php include "../include/js.php"; ?>      
    </body>
</html>