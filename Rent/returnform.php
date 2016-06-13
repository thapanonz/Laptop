<?php
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
							$sql1 = $db->prepare("SELECT prename,firstname,lastname FROM Customer WHERE Id='".$row['citizenId']."'"); 
							$sql1->execute();
							$sql1->setFetchMode(PDO::FETCH_ASSOC);
							while ($row1 = $sql1->fetch()) { ?>
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
							<?php } ?>     
					    </div>

					    <div class="form-group">
					      <label>วันที่เช่า:</label>
					      <input disabled type="text" class="form-control" value="<?php echo $row["rentlap"] ?>">
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
					     <div class="form-group">
					      <label>วันที่คืน:</label>
					      <input id="rentdate" type="text"  class="form-control" name="returnlap">
					    </div>

					    <div class="form-group">
					      <label>เจ้าหน้าที่ให้บริการ:</label>
					      <select class="form-control" name="staffId">
							<?php
								$sql = $db->prepare("SELECT Id,pname,name,lastname FROM permission  
									                 ORDER BY user");
								$sql->execute();
								$sql->setFetchMode(PDO::FETCH_ASSOC);
								while ($row = $sql->fetch()) { ?>
									<option value="<?=$row['Id'] ?>"><?php echo $row["pname"].$row["name"]."&nbsp;".$row["lastname"] ?></option>
							<?php } ?>  
						</select>
					    </div>
				<?php } ?>						
						<div style="text-align: center">
					   	   <button type="submit" class="btn btn-success">บันทึก</button>				   		<a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
					</div>		

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
						var newdate = new Date(d);
						var number = parseInt( $('#setday').val(), 10);
						newdate.setDate(d.getDate() + number);
					    $.datetimepicker.setLocale('th');
					    $('#duedate').datetimepicker({             
					        format: 'Y-m-d 12:00', 
					        value: newdate,  });
					});

					$.mask.definitions['~']='[+-]';
			  		$('#citizenId').mask('9-9999-99999-99-9');
			});
         </script> 
    </body>
</html>