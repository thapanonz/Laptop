<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
	require "../include/connect.php";
	require "../include/functions.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "record";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>บันทึกรายการเช่า</title>
		<?php include "../include/css.php"; ?>
		<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container" >
			<h1 style="margin-left:43px">บันทึกรายการเช่า</h1><br>
			<form role="form" action="submitadd.php" method="post" onsubmit="return confirm('คุณต้องการบันทึก รายการเช่า นี้หรือไม่?');">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-5">
						<div class="form-group">
					      <label>สัญญาเช่าเลขที่: <?php echo getNewID() ?></label>
					    </div>
						<div class="form-group" style="padding-bottom: 35px">
					      <label>เลขบัตรประชาชนผู้เช่า:</label>
					      	<div class="col-sm-10" style="padding-left: 0">
					      		<input required type="text" class="form-control" name="citizenId" id="citizenId" style="letter-spacing: 1px;" placeholder="_-____-_____-__-_">
					      	</div>
							<div class="col-sm-2" style="text-align: right; padding: 0">
					      		<a id="retrieveRentor" class="btn btn-info">ค้นหา</a>	
					      	</div>
					    </div>

					    <div class="form-group" >
						     	<label>หมายเลขเครื่องเช่า:</label>
						     	<select class="form-control" name="laptopId">
								<?php
									$sql = $db->prepare("SELECT Id,nbCode FROM notebook WHERE nbStatus='rdy' 
										                 ORDER BY nbCode");
									$sql->execute();
									$sql->setFetchMode(PDO::FETCH_ASSOC);
									while ($row = $sql->fetch()) { ?>
									<option value="<?=$row['Id'] ?>"><?php echo $row["nbCode"] ?></option>
								<?php } ?>  
								</select>
							     
					    </div>

					    <div class="form-group">
					      <label>วันที่เช่า:</label>
					      <input required id="rentdate" type="text" class="form-control" name="rentlap">
					    </div>
					    <div class="form-group">
					      <label>จำนวนวัน:</label>
					      <input required id="setday" type="number" class="form-control">
					    </div>
					    <div class="form-group">
					      <label>วันครบกำหนดส่งคืน:</label>
					      <input required id="duedate"  type="text" readonly class="form-control" name="appointlap">
					    </div>

					    <div class="form-group">
					      <label>เจ้าหน้าที่ให้บริการ:</label>
					      <select class="form-control" name="staffId">
							<?php
								$sql = $db->prepare("SELECT Id,user,pname,name,lastname FROM permission  
									                 ORDER BY user");
								$sql->execute();
								$sql->setFetchMode(PDO::FETCH_ASSOC);
								while ($row = $sql->fetch()) { ?>
									<option value="<?=$row['Id'] ?>" selected="<?php ($_SESSION['userperm']==$row["user"]? $row["user"] : "" ) ?>"><?php echo $row["pname"].$row["name"]."&nbsp;".$row["lastname"] ?></option>
							<?php } ?>  
						</select>
					    </div>
										
						<div style="text-align: center">
							<input type="hidden" class="form-control" name="Id" value="<?php echo getNewID()?>">
					   	   <button type="submit" class="btn btn-success" id="btnsubmit">บันทึก</button>		 <a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
					</div>		

					<div class="col-xs-6">
						<div class="searchResult" id="searchResult"></div>
					</div>
				</div>	  
			</form>		
			</div>
						

        <?php include "../include/js.php"; ?>      
         <script src="../js/jquery.datetimepicker.full.min.js"></script> 
         <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" type="text/javascript"></script>
         <script>
         	//jQuery('#datetimepicker').datetimepicker();
         	$(document).ready(function () {
         			$("#btnsubmit").prop('disabled', true);

				    var d = new Date();
				    $.datetimepicker.setLocale('th');
				    $('#rentdate').datetimepicker({             
				        mask: true,
				        timepicker: true,
				        format: 'Y-m-d H:i',
				        value: d,
				        step: 1,
				    });

		         	$('#setday').on('change', function() {
						var d = new Date();
						var newdate = new Date( $('#rentdate').val());
						var number = parseInt( $('#setday').val(), 10);
						newdate.setDate(newdate.getDate() + number);
					    $.datetimepicker.setLocale('th');
					    $('#duedate').datetimepicker({             
					        format: 'Y-m-d 13:00', 
					        value: newdate,  });
					});

					$.mask.definitions['~']='[+-]';
			  		$('#citizenId').mask('9-9999-99999-99-9');
			  		$('#citizenId').focusout(function(){
			  			if($("#citizenId").val().split('_').join('').length != 17)
			  			{
			  				alert("กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก");
			  			}
			  		});

		  			$("#retrieveRentor").click(function(){
						var vname = $("#citizenId").val();
						if(vname.length != 17)
						{
							alert("กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก");
						}
						else{
							$.post("retrieveRentor.php", //Required URL of the page on server
							{ // Data Sending With Request To Server
							cid:vname
							},
							function(response){ // Required Callback Function
								if(response == false) {
									response = "<br><br><h3 class=\"text-danger\">ไม่พบผู้ใช้</h3>";
								    $("#searchResult").html(response);
									$("#btnsubmit").prop('disabled', true);							
								}
								else{
									$("#searchResult").html(response);
									$("#btnsubmit").prop('disabled', false);
								}
							});
						}
					});

			});
         </script> 
    </body>
</html>