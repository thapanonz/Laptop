<?php
	require "include/connect.php";
	$activepage = "home";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>หน้าแรก</title>
		<?php include "include/css.php" ?>
    </head>
    <body>
		<?php include "include/banner.php"; ?>
		
		<?php include "include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-9">						
				<?php
					$sql = $db->prepare("SELECT COUNT(Id) AS sumlaptop FROM notebook WHERE nbStatus='rdy'");
					$sql->execute();
					$sql->setFetchMode(PDO::FETCH_ASSOC);
					if ($row = $sql->fetch()) { ?>
						เครื่องพร้อมให้เช่าจำนวน <span class='label label-success'> <?php echo $row["sumlaptop"] ?></span> เครื่อง
					} ?>						
					</div>	
					<div class="col-xs-5">						
				
					</div>	
					<div class="col-xs-4">						
					<a href="acadmin/rent/index.php" class="btn btn-primary">บันทึกการเช่า</a>
					<a href="acadmin/rent/return.php" class="btn btn-primary">บันทึกการคืน</a>
					<a href="#" class="btn btn-primary">สรุปข้อมูลรายวัน</a>
					</div>	
							
				</div>
			</div>
			
		
        <?php include "include/js.php" ?>      
    </body>
</html>