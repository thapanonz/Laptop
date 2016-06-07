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
        <title>ป้อนรายการเครื่องเช่าใหม่</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

		<?php
			$Id=$_GET['Id'];
			$sql = $db->prepare("SELECT user,level FROM permission WHERE Id=$Id");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {			 	
		?>

			<div class="container">
				<div class="row">				
					<div class="col-xs-5" style="margin-left: 30px">						
						<h1>จัดการสิทธิ์</h1><br>
						<form role="form" action="submitupdatepermission.php" method="post">
						
						<p><label>ชื่อผู้ใช้ : </label> <?php echo $row["user"] ?></p>
					    
					    <div class="form-group">
					      <label>ประเภทผู้ใช้: &nbsp;&nbsp;&nbsp;</label>
					      <label class="radio-inline"><input type="radio" name="level" <?=($row["level"]=="admin")? 'checked' : ''; ?> value="admin">ผู้ดูแล</label>
						  <label class="radio-inline"><input type="radio" name="level" <?=($row["level"]=="sadmin")? 'checked' : ''; ?> value="sadmin">เจ้าหน้าที่</label>						 
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