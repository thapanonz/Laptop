<?php
	require "../include/connect.php";
	require "../include/functions.php";
	require "../include/fnDatethai.php";
	
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
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">

		<style type="text/css">
			table thead tr th {text-align: center;}
		</style>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>

		<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-8" style="margin-left: 30px">						
						<h1>บันทึกรายการคืน</h1>
						
		<br><table class="table table-bordered table-hover" id="TableReturn">
			<thead>
		      <tr bgcolor="#CCCCCC" >
		        <th>สัญญาเช่าเลขที่</th>
		        <th>ชื่อ - นามสกุล</th>	
		        <th>หมายเลขเครื่อง</th>	 
		        <th>วันที่เช่า</th>
		        <th>วันกำหนดส่งคืน</th>
		        <th></th>      	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT * FROM rentlist WHERE returnlap is NULL");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {
				echo "<tr>";
                echo "<td align=\"center\">"; ?>             
            <a href="#" data-toggle="modal" data-target="#<?php echo $row["Id"] ?>"><?php echo $row["Id"] ?></a>

                <div class="modal fade" id="<?php echo $row["Id"] ?>" role="dialog">
				    <div class="modal-dialog">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">รายการคืน</h4>
				        </div>
				        <div class="modal-body">
					        <div class="row">
					        	<div class="col-sm-12" style="font-size: 17px; margin-left: 50px; text-align: left">
									<label>สัญญาเช่าเลขที่:</label> <?php echo $row["Id"] ?><br>
									<label>ชื่อ-นามสกุล:</label> <?php echo $row["firstname"]."&nbsp;".$row["lastname"] ?><br>
									<label>หมายเลขเครื่อง:</label> <?php echo $row["nbCode"] ?><br><br>
									<label>วันที่เช่า:</label> <?php echo $row["rentlap"] ?><br>	
									<label>เจ้าหน้าที่ให้เช่า:</label> <?php echo $row["rent_firstname"]."&nbsp;".$row["rent_lastname"] ?><br><br>
									<label>วันกำหนดส่งคืน:</label> <?php echo $row["appointlap"] ?>
								</div>
							</div>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				        </div>
				      </div>      
				    </div>
				  </div>
		<?php
				echo "</td>";
				echo "<td align=\"center\">" .$row["firstname"]."&nbsp;".$row["lastname"]."</td>";   
				echo "<td align=\"center\">" .$row["nbCode"]."</td>";  
				echo "<td align=\"center\">" .DateThai($row["rentlap"])."</td>";  
				echo "<td align=\"center\">" .DateThai($row["appointlap"])."</td>";  
				echo "<td align=\"center\">";
            	   echo "<a href='returnform.php?Id=".$row['Id']."'>คืน</a>";
            	echo "</td>";
                echo "</tr>";


			} ?>
			</tbody>
		</table>
		</div>					
	</div>
</div>	
						

        <?php include "../include/js.php"; ?>  
        <script src="../js/jquery.dataTables.min.js"></script> 
        <script>
        	$(document).ready(function() {
		    	$('#TableReturn').DataTable();
			} );
        </script> 
    </body>
</html>