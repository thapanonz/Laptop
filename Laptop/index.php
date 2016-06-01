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
						<h1>รายการเครื่องเช่า</h1>
						<a href="addform.php" class="btn btn-info">เพิ่มรายการ</a>

					</div>
					
				</div>
			</div>
				
				
			
		
        <?php include "../include/js.php"; ?>      
    </body>
</html>