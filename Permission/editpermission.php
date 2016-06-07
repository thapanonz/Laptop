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
        <title>จัดการสิทธิ์</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

		<?php
			$Id=$_GET['Id'];
			$sql = $db->prepare("SELECT user,pname,name,lastname,level FROM permission WHERE Id=$Id");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {			 	
		?>

			<div class="container">
				<div class="row">				
					<div class="col-xs-5" style="margin-left: 30px">						
						<h1>จัดการสิทธิ์</h1><br>
						<form role="form" action="submitupdatepermission.php" method="post">
						<?php $rdo="" ?>
						<div>
							<h4>ชื่อผู้ใช้ : </h4> <?php echo $row["user"] ?>
						</div>
						<div>
							<h4>คำนำหน้าชื่อ : </h4>
								<input type="text" class="form-control" name="pname" value="<?php echo $row["pname"] ?>">
						</div>
						<div>
							<h4>ชื่อ : </h4>
								<input type="text" class="form-control" name="name" value="<?php echo $row["name"] ?>">
						</div>
						<div>
							<h4>นามสกุล : </h4>
								<input type="text" class="form-control" name="lastname" value="<?php echo $row["lastname"] ?>">
					    </div>
					    
					    <div class="form-group">
					      <h4>ประเภทผู้ใช้: &nbsp;&nbsp;&nbsp;</h4>
					      <h5 class="radio-inline"><input type="radio" name="level" <?=($row["level"]=="admin")? 'checked' : ''; ?> value="admin">ผู้ดูแล</h5>
						  <h5 class="radio-inline"><input type="radio" name="level" <?=($row["level"]=="sadmin")? 'checked' : ''; ?> value="sadmin">เจ้าหน้าที่</h5>						 
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