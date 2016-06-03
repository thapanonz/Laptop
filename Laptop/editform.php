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
        <title>ป้อนรายการเครื่องเช่าใหม่</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

		<?php
			$Id=$_GET['Id'];
			$sql = $db->prepare("SELECT Id,nbCode,nbSerial,nbBrand,nbDetails,nbStatus FROM notebook WHERE Id=$Id");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {			 	
		?>

			<div class="container">
				<div class="row">				
					<div class="col-xs-5" style="margin-left: 30px">						
						<h1>รายการเครื่องเช่า</h1><br>
						<form role="form" action="submitupdate.php" method="post">
						<?php $rdo="" ?>
					    <div class="form-group">
					      <label>หมายเลขเครื่องเช่า:</label>
					      <input type="text" class="form-control" name="nbCode" value="<?php echo $row["nbCode"] ?>"> 
					    </div>
					    <div class="form-group">
					      <label>ซีเรียลเครื่องเช่า:</label>
					      <input type="text" class="form-control" name="nbSerial" value="<?php echo $row["nbSerial"] ?>">
					    </div>
					    <div class="form-group">
					      <label>ยี่ห้อ/รุ่น:</label>
					      <input type="text" class="form-control" name="nbBrand" 
					      value="<?php echo $row["nbBrand"] ?>"></div>
					    <div class="form-group">
					      <label>รายละเอียดของเครื่อง:</label>
					      <textarea class="form-control" name="nbDetails" rows="5"><?php echo $row["nbDetails"] ?></textarea>
					    </div>
					    <div class="form-group">
					      <label>สถานะเครื่อง: &nbsp;&nbsp;&nbsp;</label>
					      <label class="radio-inline"><input type="radio" name="nbStatus" <?=($row["nbStatus"]=="rdy")? 'checked' : ''; ?> value="rdy">พร้อมใช้งาน</label>
						  <label class="radio-inline"><input type="radio" name="nbStatus" <?=($row["nbStatus"]=="notrdy")? 'checked' : ''; ?> value="notrdy">ไม่พร้อมใช้งาน</label>
						  <label class="radio-inline"><input type="radio"  name="nbStatus" <?=($row["nbStatus"]=="rent")? 'checked' : ''; ?> value="rent">ถูกเช่า</label>
					    </div>					
				<?php } ?>
					   <div style="text-align: center">
							<input type="hidden" class="form-control" name="Id" value="
							<?php echo $Id ?>">

						    <button type="submit" class="btn btn-success">บันทึก</button>				   <a href="index.php" class="btn btn-primary">ยกเลิก</a>
					   </div>		   
					    </form>			
					</div>					
				</div>
			</div>
				

        <?php include "../include/js.php"; ?>      
    </body>
</html>