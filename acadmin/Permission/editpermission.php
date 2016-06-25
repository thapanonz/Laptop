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
        <title>แก้ไขจัดการสิทธิ์</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body style="background-color:lightgrey;">
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
					<div class="col-xs-4" style="margin-left: 30px">						
						<h1>แก้ไขจัดการสิทธิ์</h1><br>
						<form role="form" action="submitupdatepermission.php" method="post">					
						<div class="form-group">
							<label>ชื่อผู้ใช้:</label>&nbsp;<?php echo $row["user"] ?>
						</div>
						<div class="form-group">
							<label>คำนำหน้าชื่อ</label>
								<input type="text" class="form-control" name="pname" value="<?php echo $row["pname"] ?>">
						</div>
						<div class="form-group">
							<label>ชื่อ</label>
								<input type="text" class="form-control" name="name" value="<?php echo $row["name"] ?>">
						</div>
						<div class="form-group">
							<label>นามสกุล</label>
								<input type="text" class="form-control" name="lastname" value="<?php echo $row["lastname"] ?>">
					    </div>
					    
					    <div class="form-group">
					      <label>ประเภทผู้ใช้</label><br>
					      <label class="radio-inline" style="margin-left: 30px;"><input type="radio" name="level" <?=($row["level"]=="sadmin")? 'checked' : ''; ?> value="sadmin">ผู้ดูแล</label>
						  <label class="radio-inline"><input type="radio" name="level" <?=($row["level"]=="admin")? 'checked' : ''; ?> value="admin">เจ้าหน้าที่</label>						 
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