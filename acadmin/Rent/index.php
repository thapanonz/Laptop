<?php
		session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
	require "../include/connect.php";
	require "../include/fnDatethai.php";

	//Set Path
	$isSubfolder = true;
	$activepage = "listallrent";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>รายการเช่าทั้งหมด</title>
		<?php include "../include/css.php"; ?>
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
					<div class="col-xs-9" style="margin-left: 30px">						
						<h1>รายการเช่า</h1>
						
		<br><table class="table table-bordered table-hover" id="TableRent">
			<thead>
		      <tr bgcolor="#CCCCCC" >
		        <th>สัญญาเช่าเลขที่</th>
		        <th>ชื่อ - นามสกุล</th>	
		        <th>หมายเลขเครื่อง</th>	 
		        <th>วันที่เช่า</th>
		        <th>วันกำหนดส่งคืน</th>
		        <th>วันที่คืน</th>  
		        <th></th>    	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT * FROM rentlist ORDER BY Id DESC");
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
				          <h4 class="modal-title">รายการเช่า</h4>
				        </div>
				        <div class="modal-body">
					        <div class="row">
					        	<div class="col-sm-12" style="font-size: 17px; margin-left: 50px; text-align: left">
									 <label>สัญญาเช่าเลขที่:</label> <?php echo $row["Id"] ?><br>
									<label>ชื่อ-นามสกุล:</label> <?php echo $row["firstname"]."&nbsp;".$row["lastname"] ?><br>
									<label>หมายเลขเครื่อง:</label> <?php echo $row["nbCode"] ?><br><br>
									<label>วันที่เช่า:</label> <?php echo DateThai($row["rentlap"]) ?><br>	
									<label>เจ้าหน้าที่ให้บริการ:</label> <?php echo $row["rent_firstname"]."&nbsp;".$row["rent_lastname"] ?><br><br>
									<label>วันกำหนดส่งคืน:</label> <?php echo DateThai($row["appointlap"]) ?><br><br>
									<label>วันที่คืน:</label> <?php echo ($row["returnlap"]==NULL? "<span class='label label-danger'>ยังไม่คืน</span>" : DateThai($row["returnlap"]) ) ?><br>			    
									<label>เจ้าหน้าที่รับคืน:</label> <?php echo ($row["returnlap"]==NULL? "<span class='label label-danger'>ยังไม่คืน</span>" : $row["return_firstname"]." ".$row["return_lastname"]) ?><br>
								</div>
							</div>
				        </div>
				        <div class="modal-footer">

				        	<!-- <a href="editrent.php?Id=<?=$row['Id'] ?>" class="btn btn-warning">แก้ไข</a> -->
				        	
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
				echo "<td align=\"center\">" .($row["returnlap"]==NULL? "<span class='label label-danger'>ยังไม่คืน</span>" : DateThai($row["returnlap"]) )."</td>";    
				echo "<td><a class='popup' href='agreement.php?Id=".$row['Id']."'><i class='fa fa-print'></i></a></td>";
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
		    	$('#example').DataTable();

		    	$('.popup').click(function(){
		    		var NWin = window.open($(this).prop('href'),'','height=900,width=1000');
		    		if(window.focus)
		    		{
		    			NWin.focus();
		    		}
		    		return false;
		    	});
			});
        </script> 
		<script src="../js/jquery.dataTables.min.js"></script> 
        <script>
        	$(document).ready(function() {
		    	$('#TableLaptop').DataTable();
			} );
        </script>  
    </body>
</html>


