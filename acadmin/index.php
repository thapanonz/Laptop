<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: login.php?error=2'); 
	}

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

		<style type="text/css" media="screen">
			.btn-lg {
				padding: 10px 30px 10px 30px;
				margin-top: 10px;
				width: 65%;
			}
		</style>
    </head>
    <body>
		<?php include "include/banner.php"; ?>
		
		<?php include "include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-11">						
				<?php
					$sql = $db->prepare("SELECT COUNT(Id) AS sumlaptop FROM notebook WHERE nbStatus='rdy'");
					$sql->execute();
					$sql->setFetchMode(PDO::FETCH_ASSOC);
					if ($row = $sql->fetch()) { ?>
						<h2>เครื่องพร้อมให้บริการเช่าจำนวน <span class='label label-success'> <?php echo $row["sumlaptop"] ?></span> เครื่อง</h2>
					<?php } ?>	
					</div>
					
					<div class="col-xs-6">	
						<img src="imgs/Lenovo G4080.png" height="450" width="580">			
					</div>	

					<div class="col-xs-5">
					<br>						
					<a href="rentor/addform.php" class="btn btn-lg btn-success">บันทึกข้อมูลผู้เช่าใหม่</a><br>		
					<a href="rent/add.php" class="btn btn-lg btn-primary">บันทึกการเช่า</a><br>
					<a href="rent/return.php" class="btn btn-lg btn-danger">บันทึกการคืน</a><br>
					<a href="report/daily.php" class="btn btn-lg btn-warning">สรุปข้อมูลรายวัน</a>
					</div>							
				</div>
			</div>
				
        <?php include "include/js.php" ?>      
    </body>
</html>