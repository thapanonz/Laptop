<?php
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
			<h1 style="margin-left:43px">แก้ไขรายการเช่า</h1><br>
			<form role="form" action="submiteditrent.php" method="post">	
			<?php
				$Id=$_GET["Id"];
				$sql = $db->prepare("SELECT * FROM rent WHERE Id=$Id");
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				while ($row = $sql->fetch()) { ?>

				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-5">
						<div class="form-group">
					      <label>สัญญาเช่าเลขที่: <?php echo $row["Id"] ?></label>
					    </div>
						<div class="form-group">
					      <label>ข้อมูลผู้เช่า:</label>
					      <?php							
							$sql5 = $db->prepare("SELECT prename,firstname,lastname,type FROM Customer WHERE Id='".$row['citizenId']."'"); 
							$sql5->execute();
							$sql5->setFetchMode(PDO::FETCH_ASSOC);
							while ($row5 = $sql5->fetch()) { 
									$feeStm = $db->prepare("SELECT fee_value FROM fee WHERE fee_type='".$row5['type']."'"); 
									$feeStm->execute();
									$feeStm->setFetchMode(PDO::FETCH_ASSOC);
									while ($fee = $feeStm->fetch()) { ?>
										<input type="hidden" id="feevalue" name="feevalue" value="<?=$fee['fee_value']?>">
										<?php
									}
									$fineStm = $db->prepare("SELECT fee_value FROM fee WHERE fee_type = 'fine'"); 
									$fineStm->execute();
									$fineStm->setFetchMode(PDO::FETCH_ASSOC);
									while ($fine = $fineStm->fetch()) { ?>
										<input type="hidden" id="finevalue" name="finevalue" value="<?=$fine['fee_value']?>">
								<?php }	?>
													      
					      	<input type="text" disabled class="form-control" name="citizenId" value="<?php echo $row["citizenId"]." : ".$row5["prename"].$row5["firstname"]." ".$row5["lastname"] ?>">
					      		<?php } ?>	
					    </div>

					    <div class="form-group" >
						     	<label>หมายเลขเครื่องเช่า:</label>
						     	<select class="form-control" name="laptopId">
						     	<?php
									$sql1 = $db->prepare("SELECT Id,nbCode FROM notebook WHERE Id=".$row["laptopId"]);
									$sql1->execute();
									$sql1->setFetchMode(PDO::FETCH_ASSOC);
									while ($row1 = $sql1->fetch()) { ?>
									<option value="<?=$row1["Id"] ?>"><?php echo $row1["nbCode"] ?></option>
								<?php } ?>  
								<?php
									$sql2 = $db->prepare("SELECT Id,nbCode FROM notebook WHERE nbStatus='rdy' 
										                 ORDER BY nbCode");
									$sql2->execute();
									$sql2->setFetchMode(PDO::FETCH_ASSOC);
									while ($row2 = $sql2->fetch()) { ?>
									<option value="<?=$row2["Id"] ?>"><?php echo $row2["nbCode"] ?></option>
								<?php } ?>  
								</select>
							     
					    </div>

					    <div class="form-group">
					      <label>วันที่เช่า:</label>
					      <input id="rentdate" type="text" class="form-control" name="rentlap" value="<?php echo $row["rentlap"] ?>">
					    </div>
					    <div class="form-group">
					      <label>จำนวนวัน:</label>
					      <input id="setday" type="number" class="form-control">
					    </div>
					    <div class="form-group">
					      <label>วันครบกำหนดส่งคืน:</label>
					      <input required id="duedate" type="text" class="form-control" name="appointlap" value="<?php echo $row["appointlap"] ?>">
					    </div>

					    <div class="form-group">
					      <label>เจ้าหน้าที่ให้บริการ:</label>
					      <select class="form-control" name="staffId">
					      <?php
								$sql3 = $db->prepare("SELECT Id,pname,name,lastname FROM permission  
									                 WHERE Id=".$row["staffId"]);
								$sql3->execute();
								$sql3->setFetchMode(PDO::FETCH_ASSOC);
								while ($row3 = $sql3->fetch()) { ?>
									<option value="<?=$row3["Id"] ?>"><?php echo $row3["pname"].$row3["name"]."&nbsp;".$row3["lastname"] ?></option>
							<?php } ?>  
							<?php
								$sql4 = $db->prepare("SELECT Id,pname,name,lastname FROM permission  
									                 WHERE Id!=".$row["staffId"]);
								$sql4->execute();
								$sql4->setFetchMode(PDO::FETCH_ASSOC);
								while ($row4 = $sql4->fetch()) { ?>
									<option value="<?=$row["Id"] ?>"><?php echo $row4["pname"].$row4["name"]."&nbsp;".$row4["lastname"] ?></option>
							<?php } ?>  
						</select>
					    </div>	    
					</div>	
					
					<div class="col-xs-5" style="margin-left: 30px">
					     <div class="form-group" style="padding-bottom: 57px">
					     	<div class="col-sm-12" style="padding-left: 0">
					      		<label>วันที่คืน:</label>
					      	</div>
					      	<div class="col-sm-10" style="padding-left: 0">
					      		<input id="returndate" <?=($row["returnlap"]==Null ? "disabled" : "") ?> type="text" class="form-control" name="returnlap" value="<?php echo $row["returnlap"] ?>">
					      	</div>
							<div class="col-sm-2" style="text-align: right; padding: 0">
					      		<a id="calFee" class="btn btn-info">คำนวนเงิน</a>	
					      	</div>
					    </div>

					    <div class="form-group">
					     <label>สถานะ:</label>
					     <select <?=($row["isLate"]==Null ? "disabled" : "") ?> class="form-control" name="isLate">	
					      	<option  <?=($row["isLate"]==NULL? "selected" : "") ?>>ยังไม่คืน</option>		   <option <?=($row["isLate"]=='0'? "selected" : "") ?> value="0">ปกติ</option>
							<option <?=($row["isLate"]=='1'? "selected" : "") ?> value="1">สาย</option>
						</select>
						</div>
					      	
					    <div class="form-group">					    	
					      		<label>จำนวนเงิน:</label>					      	
					     	 <input id="fee" readonly <?=($row["returnlap"]==NULL? "disabled" : "") ?> type="text"  class="form-control" name="fee" value="<?php echo $row["cost"] ?>">
					    </div>

					    <div class="form-group">
					      <label>เจ้าหน้าที่รับบริการคืน:</label>
					      <select <?=($row["returnlap"]==Null ? "disabled" : "") ?> class="form-control" name="returnstaffId">
					      <?php
								$sql3 = $db->prepare("SELECT Id,pname,name,lastname FROM permission  
									                 WHERE Id=".$row["returnstaffId"]);
								$sql3->execute();
								$sql3->setFetchMode(PDO::FETCH_ASSOC);
								while ($row3 = $sql3->fetch()) { ?>
									<option value="<?=$row3["Id"] ?>"><?php echo $row3["pname"].$row3["name"]."&nbsp;".$row3["lastname"] ?></option>
							<?php } ?>  
							<?php
								$sql4 = $db->prepare("SELECT Id,pname,name,lastname FROM permission  
									                 WHERE Id!=".$row["returnstaffId"]);
								$sql4->execute();
								$sql4->setFetchMode(PDO::FETCH_ASSOC);
								while ($row4 = $sql4->fetch()) { ?>
									<option value="<?=$row4["Id"] ?>"><?php echo $row4["pname"].$row4["name"]."&nbsp;".$row4["lastname"] ?></option>
							<?php } ?>  
						</select>
					    </div>
				 					
						<div style="text-align: center">
						<input type="hidden" name="Id" value="<?php echo $Id ?>">
					   	   <button type="submit" class="btn btn-success">บันทึก</button>			
					   	   <a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>					
					</div>			
				</div>

				<?php } ?> 
			</form>		
			</div>
						

        <?php include "../include/js.php"; ?>      
         <script src="../js/jquery.datetimepicker.full.min.js"></script> 
         <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" type="text/javascript"></script>
         <script>
         	//jQuery('#datetimepicker').datetimepicker();
         	$(document).ready(function () {
				    var d = new Date();
				    $.datetimepicker.setLocale('th');
				    $('#rentdate,#returndate').datetimepicker({             
				        mask: false,
				        timepicker: true,
				        format: 'Y-m-d H:i',
				        //value: d,
				        step: 1,
				    });

		         	$('#setday').on('change', function() {
						var d = new Date($('#rentdate').val());
						var newdate = new Date(d);
						var number = parseInt( $('#setday').val(), 10);
						newdate.setDate(d.getDate() + number);
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

			  		$('#calFee').click(function(){
			  			// Init
			  			var startdate = $('#rentdate').val();
			  			var returndate = $('#returndate').val()
			  			var duedate = $('#duedate').val()
			  			var fee = $('#feevalue').val();
			  			var fine = 0;

			  			//Calculate Days
			  			startdate = new Date(startdate);
			  			startdate.setHours(13);
			  			startdate.setMinutes(0);
			  			returndate = new Date(returndate);		  			
			  			diff = returndate - startdate;
			  			var days = Math.ceil(diff/1000/60/60/24);	

			  			// Check Late
			  			duedate = new Date(duedate);		  		
			  			if(returndate > duedate)
			  			{
			  				$('#isLate').val(1);
			  				fine = $('#finevalue').val();

			  			}

			  			// Calculate Fee
			  			fee = (days*fee)+parseInt(fine);
			  			
			  			
						$('#rentdays').val(days);
						$('#fee').val(fee);
			  		})
			});
         </script> 
    </body>
</html>