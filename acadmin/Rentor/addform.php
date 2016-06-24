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
        <title>ป้อนรายการผู้เช่าใหม่</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container" >
			<h1 style="margin-left:43px">ป้อนรายการผู้เช่าใหม่</h1><br>
			<form role="form" action="submitadd.php" method="post">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-5">													
						<div class="form-group">
							<label>ประเภทผู้เช่า:</label><br/>
					      	<div class="radio" style="margin-left: 15px;">
						      	<label><input type="radio" name="type" value="student" checked="checked">นักศึกษา</label>
						      	<label style="margin-left: 30px;"><input type="radio" name="type" value="personnel">บุคลากร</label>
					     	</div>
					    </div>	
						<div class="form-group">
					      <label>เลขบัตรประชาชน:</label>
					      <input required type="text" class="form-control" name="Id" id="citizenId" style="letter-spacing: 1px;" placeholder="ตัวอย่าง: 1-5646-46454-54-6"> 
					    </div>
					    <div class="form-group">
					      <label>รหัสนักศึกษา/บุคลากร:</label>
					      <input required type="text" class="form-control" name="passport" placeholder="ตัวอย่าง: 5610210000@psu.ac.th">
					    </div>
					    <div class="form-group">
					      <label>คำนำหน้าชื่อ:</label>
					      <input required type="text" class="form-control" name="prename" 
					      placeholder="ตัวอย่าง: นาย,นาง,นางสาว">
					    </div>
					    <div class="form-group">
					      <label>ชื่อ:</label>
					      <input required type="text" class="form-control" name="firstname" 
					      placeholder="ตัวอย่าง: สมชาย">
					    </div>
					    <div class="form-group">
					      <label>นามสกุล:</label>
					      <input required type="text" class="form-control" name="lastname" 
					      placeholder="ตัวอย่าง: ทองดี">
					    </div>  
					</div>


					<div class="col-xs-5" style="margin-left: 30px">										<div class="form-group">
					      <label>คณะ/หน่วยงาน:</label>
					      <input required type="text" class="form-control" name="faculty" 
					      placeholder="ตัวอย่าง: วิศวกรรมศาสตร์">
					    </div>
					    <div class="form-group">
					      <label>ภาควิชา:</label>
					      <input type="text" class="form-control" name="department" 
					      placeholder="ตัวอย่าง: วิศวกรรมเครื่องกล">
					    </div>
					    <div class="form-group">
					      <label>เบอร์โทรศัพท์:</label>
					      <input required type="text" class="form-control" name="phone" 
					      placeholder="ตัวอย่าง: 0875698563">
					    </div>
					    <div class="form-group">
					      <label>อีเมล์:</label>
					      <input type="text" class="form-control" name="email" 
					      placeholder="ตัวอย่าง: Johnny@hotmail.com">
					    </div>	   	
					     <div class="form-group">
					      <label>ที่อยู่:</label>
					      <textarea class="form-control" name="address" rows="5"
					      placeholder="ตัวอย่าง: ศูนย์สุขภาพศรีพัฒน์ คณะแพทย์ศาสตร์ ม.เชียงใหม่  		  เลขที่ 110/392 ถ.อินทวโรรส ต.ศรีภูมิ อ.เมือง จ.เชียงใหม่ 77025"></textarea>
					    </div>
						<div class="text-right">
					   	   <button type="submit" class="btn btn-success">บันทึก</button>				   <a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
					</div>				
				</div>	  
			</form>		
			</div>
						

        <?php include "../include/js.php"; ?>   
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script>
        $.mask.definitions['~']='[+-]';
		$('#citizenId').mask('9-9999-99999-99-9');  
		</script> 
    </body>
</html>