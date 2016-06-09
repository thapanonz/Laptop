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
			<h1 style="margin-left:43px">บันทึกรายการเช่า</h1><br>
			<form role="form" action="submitadd.php" method="post">	
				<div class="row" style="margin-left: 30px">				
					<div class="col-xs-5">
						<div class="form-group">
					      <label>สัญเช่าเลขที่: <?php echo getNewID() ?></label>
					    </div>
						<div class="form-group">
					      <label>เลขบัตรประชาชนผู้เช่า:</label>
					      <input required type="text" class="form-control" name="citizenId"> 
					    </div>


				    <div class="form-group" >
				     	<label>หมายเลขเครื่องเช่า:</label>
				     	<select class="form-control" name="nbCode">
				<?php
					$sql = $db->prepare("SELECT nbCode FROM notebook WHERE nbStatus='rdy' ORDER BY nbCode");
					$sql->execute();
					$sql->setFetchMode(PDO::FETCH_ASSOC);
					while ($row = $sql->fetch()) { ?>
						<option value="<?php $row["Id"] ?>"><?php echo $row["nbCode"] ?></option>
				<?php } ?>  
						</select>
					      <!-- <input required type="text" class="form-control" name="laptopId"> -->
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
					      <input required type="text" class="form-control" name="staff">
					    </div> 
										
						<div style="text-align: center">
					   	   <button type="submit" class="btn btn-success">บันทึก</button>				   <a href="index.php" class="btn btn-primary">ยกเลิก</a>
						</div>
					</div>				
				</div>	  
			</form>		
			</div>
						

        <?php include "../include/js.php"; ?>      
         <script src="../js/jquery.datetimepicker.full.min.js"></script> 
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
					        format: 'Y-m-d H:i', //format: 'Y-m-d 12:00',
					        value: newdate,  });
					});
			});
         </script> 
    </body>
</html>