<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}

	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "listalluser";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>แก้ไขรายการผู้เช่า</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	
		
		<?php
			$sql = "SELECT * FROM customer where Id LIKE :Id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':Id', $_GET['Id'], PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $stmt->fetch()) {			 	
		?>
			<div class="container">
			<h1 style="margin-left:43px">แก้ไขรายการผู้เช่า</h1><br>
			<form role="form" action="submitupdate.php" method="post">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-5">													
						<div class="form-group">
							<label>ประเภทผู้เช่า:&nbsp;&nbsp;&nbsp;</label>
					      	<label class="radio-inline"><input type="radio" name="type" value="student" <?=($row["type"]=="student")? 'checked' : ''; ?>>นักศึกษา</label>
							<label class="radio-inline"><input type="radio" name="type" value="personnel" <?=($row["type"]=="personnel")? 'checked' : ''; ?>>บุคลากร</label>
					    </div>	
						<div class="form-group">
					      <label>เลขบัตรประชาชน:</label>  <?php echo $row["Id"] ?>
					     <!--  <input required type="text" class="form-control" name="Id" value="<?php echo $row["Id"] ?>">  -->
					    </div>

					     <div class="form-group">
					     <label>สถานะ:</label>
					     <select class="form-control" name="isBlacklist">	
					    	<option <?=($row["isBlacklist"]=='0'? "selected" : "") ?> value="0">ปกติ</option>
							<option <?=($row["isBlacklist"]=='1'? "selected" : "") ?> value="1">บัญชีดำ</option>
						</select>
						</div>

					    <div class="form-group">
					      <label>รหัสนักศึกษา/บุคลากร:</label>
					      <input required type="text" class="form-control" name="passport" value="<?php echo $row["passport"] ?>">
					    </div>
					    <div class="form-group">
					      <label>คำนำหน้าชื่อ:</label>
					      <input required type="text" class="form-control" name="prename" 
					      value="<?php echo $row["prename"] ?>">
					    </div>
					    <div class="form-group">
					      <label>ชื่อ:</label>
					      <input required type="text" class="form-control" name="firstname" 
					      value="<?php echo $row["firstname"] ?>">
					    </div>
					    <div class="form-group">
					      <label>นามสกุล:</label>
					      <input required type="text" class="form-control" name="lastname" 
					      value="<?php echo $row["lastname"] ?>">
					    </div>  
					</div>


					<div class="col-xs-5" style="margin-left: 30px">										<div class="form-group">
					      <label>คณะ/หน่วยงาน:</label>
					      <input required type="text" class="form-control" name="faculty" 
					      value="<?php echo $row["faculty"] ?>">
					    </div>
					    <div class="form-group">
					      <label>ภาควิชา:</label>
					      <input type="text" class="form-control" name="department" 
					      value="<?php echo $row["department"] ?>">
					    </div>
					    <div class="form-group">
					      <label>เบอร์โทรศัพท์:</label>
					      <input required type="text" class="form-control" name="phone" 
					      value="<?php echo $row["phone"] ?>">
					    </div>
					    <div class="form-group">
					      <label>อีเมล์:</label>
					      <input type="text" class="form-control" name="email" 
					      value="<?php echo $row["email"] ?>">
					    </div>	   	
					    <div class="form-group">
					      <label>ที่อยู่:</label>
					      <textarea class="form-control" name="address" rows="5"><?php echo $row["address"] ?></textarea>
					    </div>
		<?php } ?>
						<div class="text-right">
						<input type="hidden" class="form-control" name="Id" value="<?php echo $_GET['Id']; ?>">

					   	   	<button type="submit" class="btn btn-success">บันทึก</button>				  <a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
					</div>				
				</div>	  
			</form>		
		</div>					

        <?php include "../include/js.php"; ?>      
    </body>
</html>