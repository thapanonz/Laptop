<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
	require "../include/connect.php";
	require "../include/functions.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "return";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>บันทึกรายการคืน</title>
		<?php include "../include/css.php"; ?>
		<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container" >
			<h1 style="margin-left:43px">บันทึกรายการคืน</h1><br>
			<form role="form" action="submitreturn.php" method="post">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-5">
			<?php
			$Id=$_GET['Id'];
			$sql = $db->prepare("SELECT * FROM rent WHERE Id=$Id");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) { ?>
						<div class="form-group">
					      <label>สัญญาเช่าเลขที่: <?php echo $Id ?></label>
					    </div>
					
						<div class="form-group">
					      <label>ผู้เช่า:</label>
					      <?php							
							$sql1 = $db->prepare("SELECT prename,firstname,lastname,type FROM Customer WHERE Id='".$row['citizenId']."'"); 
							$sql1->execute();
							$sql1->setFetchMode(PDO::FETCH_ASSOC);
							while ($row1 = $sql1->fetch()) { 

									$feeStm = $db->prepare("SELECT fee_value FROM fee WHERE fee_type='".$row1['type']."'"); 
									$feeStm->execute();
									$feeStm->setFetchMode(PDO::FETCH_ASSOC);
									while ($fee = $feeStm->fetch()) 
									{ 

										?>
										<input type="hidden" id="feevalue" name="feevalue" value="<?=$fee['fee_value']?>">
										<?php

									}

									$fineStm = $db->prepare("SELECT fee_value FROM fee WHERE fee_type = 'fine'"); 
									$fineStm->execute();
									$fineStm->setFetchMode(PDO::FETCH_ASSOC);
									while ($fine = $fineStm->fetch()) 
									{ 

										?>
										<input type="hidden" id="finevalue" name="finevalue" value="<?=$fine['fee_value']?>">
										<?php

									}
							
							?>

					      		<input disabled type="text" class="form-control" value="<?php echo $row1["prename"].$row1["firstname"]." ".$row1["lastname"] ?>">
					      	<?php } ?>    							
					    </div>

					    <div class="form-group" >
				     	  <label>หมายเลขเครื่องเช่า:</label>
				     	  <?php							
							$sql2 = $db->prepare("SELECT nbCode FROM Notebook WHERE Id=".$row['laptopId']); 
							$sql2->execute();
							$sql2->setFetchMode(PDO::FETCH_ASSOC);
							while ($row2 = $sql2->fetch()) { ?>
				     	  <input disabled type="text" class="form-control" value="<?php echo $row2["nbCode"] ?>">
							<?php 
							} 
							?>     
					    </div>

					    <div class="form-group">
					      <label>วันที่เช่า:</label>
					      <input disabled type="text" id="rentdate" class="form-control" value="<?php echo $row["rentlap"] ?>">
					    </div>				
					   
					    <div class="form-group">
					      <label>วันครบกำหนดส่งคืน:</label>
					      <input disabled id="duedate"  type="text" class="form-control" value="<?php echo $row["appointlap"] ?>">
					    </div>

					    <div class="form-group">
					      <label>เจ้าหน้าที่ให้บริการ:</label>
					      <?php							
							$sql3 = $db->prepare("SELECT pname,name,lastname FROM permission WHERE Id=".$row['staffId']); 
							$sql3->execute();
							$sql3->setFetchMode(PDO::FETCH_ASSOC);
							while ($row3 = $sql3->fetch()) { ?>
					       <input disabled type="text" class="form-control" value="<?php echo $row3["pname"].$row3["name"]." ".$row3["lastname"] ?>">
					       <?php } ?>
					    </div>
					</div>
					

					<div class="col-xs-5" style="margin-left: 30px">
					<form role="form" action="submitreturn.php" method="post">
					     <div class="form-group" style="padding-bottom: 57px">
					     	<div class="col-sm-12" style="padding-left: 0">
					      		<label>วันที่คืน:</label>
					      	</div>
					      	<div class="col-sm-10" style="padding-left: 0">
					      		<input id="returndate" readonly type="text" class="form-control" name="returnlap">
					      	</div>
							<div class="col-sm-2" style="text-align: right; padding: 0">
					      		<a id="calFee" class="btn btn-info">คำนวนเงิน</a>	
					      	</div>
					    </div>

					    <div class="form-group">
					    	<div class="col-sm-12" style="padding-left: 0">
					      		<label>จำนวนวัน:</label>
					      	</div>
					     	 <input readonly id="rentdays" type="text"  class="form-control">
					    </div>
					    <div class="form-group">					    	
					      		<label>จำนวนเงิน:</label>					      	
					     	 <input id="fee" readonly type="text"  class="form-control" name="fee">
					    </div>
						
						<div class="form-group">
					     <label class="checkbox-inline"><input id="isFine" type="checkbox" name="isFine" value="1">ปรับ</label>&nbsp;&nbsp;<label id="txtlate"> </label>
					    </div>	

					    <div class="form-group">
					      <label>เจ้าหน้าที่รับบริการคืน:</label>
					      <select class="form-control" name="returnstaffId">
							<?php
								$sql = $db->prepare("SELECT Id,pname,name,lastname FROM permission  
									                 ORDER BY user");
								$sql->execute();
								$sql->setFetchMode(PDO::FETCH_ASSOC);
								while ($row = $sql->fetch()) { ?>
									<option value="<?=$row['Id'] ?>" selected="<?php ($_SESSION['userperm']==$row["user"]? $row["user"] : "" ) ?>"><?php echo $row["pname"].$row["name"]."&nbsp;".$row["lastname"] ?></option>
							<?php } ?>  
						</select>
					    </div>
				 					
						<div style="text-align: center">
						<input id="isLate" type="hidden" name="isLate" value="0">
						<input type="hidden" name="Id" value="<?php echo $Id ?>">
					   	   <button id="btnsubmit" type="submit" class="btn btn-success">บันทึก</button>			
					   	   <a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
						</form>
					</div>		
				<?php } ?>
					<div class="col-xs-5">
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
         		$("#isFine").prop('disabled', true);

				    var d = new Date();
				    $.datetimepicker.setLocale('th');
				    $('#returndate').datetimepicker({             
				        mask: true,
				        timepicker: true,
				        format: 'Y-m-d H:i',
				        value: d,
				        step: 1,
				    });

					$.mask.definitions['~']='[+-]';
			  		$('#citizenId').mask('9-9999-99999-99-9');

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
			  				$("#isFine").prop('disabled', false);
			  				$('#isLate').val(1);
			  				$("#txtlate").html("<span class='label label-danger'>สาย</span>");
			  			}

			  			if($('#isFine').is(':checked'))
				  		{
			  				$('#isFine').val(1);
			  				fine = $('#finevalue').val();

				  		}

			  			// Calculate Fee
			  			fee = (days*fee)+parseInt(fine);
			  			
			  			
						$('#rentdays').val(days);
						$('#fee').val(fee);

						$("#btnsubmit").prop('disabled', false);
			  		});
					$('#isFine').click(function(){
				  		
						if($('#isFine').is(':checked'))
				  		{
			  				$('#isFine').val(1);
			  				$('#fee').val(parseInt($('#fee').val(),10)+parseInt($('#finevalue').val()));	  			
				  		}
				  		else
				  		{
				  			$('#isFine').val(0);
				  			$('#fee').val(parseInt($('#fee').val(),10)-parseInt($('#finevalue').val()));
				  		}
				  	});
			});
         </script> 
    </body>
</html>