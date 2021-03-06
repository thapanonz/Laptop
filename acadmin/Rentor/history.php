<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}

	require "../include/connect.php";
	require "../include/fnDatethai.php";

	//Set Path
	$isSubfolder = true;
	$activepage = "history";

	function setlate($late){
		if($late=="0"){ return "ปกติ";}
		else if($late=="1"){ return "<span class='label label-danger'>สาย</span>";}
		else if($late==NULL){return ""; }
	}		
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ประวัติการเช่า</title>
		<?php include "../include/css.php"; ?>
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">

		<style type="text/css">
			table thead tr th {text-align: center;}
		</style>	
    </head>
    <body>
		<?php include "../include/banner.php"; ?>
		
			<?php include "../include/menu.php"; ?>	

			<?php
				$sql = $db->prepare("SELECT * FROM customer WHERE Id LIKE :Id");
				$sql->bindParam(':Id', $_GET['Id'], PDO::PARAM_STR);			
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				while ($row = $sql->fetch()) { 
			?>
			<div class="container">
			<h1 style="margin-left:50px">ประวัติการเช่า</h1>
				<div class="row">
					<div class="col-md-11" style="margin-left: 30px">						
												
					<?php
						$sql5 = $db->prepare("SELECT COUNT(isLate) AS countlate FROM rent WHERE citizenId LIKE :Id AND isLate='1'");
						$sql5->bindParam(':Id', $row['Id'], PDO::PARAM_STR);	
						$sql5->execute();
						$sql5->setFetchMode(PDO::FETCH_ASSOC);  ?>
						<h3 style="margin: 17px 0 0 0;"><b>ผู้เช่า:</b> <?php echo $row["prename"].$row["firstname"]." ".$row["lastname"] ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php if ($row5 = $sql5->fetch()) { 
							if($row5["countlate"] != 0) { echo "<b>สาย:</b> <span class='label label-danger'>".$row5["countlate"]."</span> ครั้ง"; } else { echo "<label class=\"text-success\"><u>ไม่พบ</u>การคืนสาย</label>"; }
						 } ?></h3>
												
					<br><table id="TableHistory" class="table table-bordered table-hover">
					<thead>
				      <tr bgcolor="#CCCCCC" >
				        <th>สัญญาเช่าเลขที่</th>
				        <th>หมายเลขเครื่อง</th>	 
				        <th>วันที่เช่า</th>
				        <th>เจ้าหน้าที่ให้เช่า</th>
				        <th>วันที่คืน</th>    
				        <th>สถานะ</th>  
				        <th>คำนวนเงิน</th> 		           
				        <th>เจ้าหน้าที่รับคืน</th>  	    	        
				      </tr>
				    </thead>
					<tbody>
					<?php
						$sql1 = $db->prepare("SELECT * FROM rent WHERE citizenId LIKE :Id");
						$sql1->bindParam(':Id', $row['Id'], PDO::PARAM_STR);	
						$sql1->execute();
						$sql1->setFetchMode(PDO::FETCH_ASSOC);
						while ($row1 = $sql1->fetch()) { 
							echo "<tr>";
							echo "<td align=\"center\">".$row1["Id"]."</td>";
							echo "<td align=\"center\">";								
										$sql2 = $db->prepare("SELECT * FROM notebook WHERE Id LIKE :laptopId");
										$sql2->bindParam(':laptopId', $row1['laptopId'], PDO::PARAM_INT);	
										$sql2->execute();
										$sql2->setFetchMode(PDO::FETCH_ASSOC);
										while ($row2 = $sql2->fetch()) { 
											echo $row2["nbCode"]; 
										 }
							echo "</td>";

							echo "<td align=\"center\">".DateThai($row1["rentlap"])."</td>"; 

										$sql3 = $db->prepare("SELECT * FROM permission WHERE Id LIKE :staffId");
										$sql3->bindParam(':staffId', $row1['staffId'], PDO::PARAM_INT);
										$sql3->execute();
										$sql3->setFetchMode(PDO::FETCH_ASSOC);
										while ($row3 = $sql3->fetch()) {
											echo "<td align=\"center\">".$row3["pname"].$row3["name"]." ".$row3["lastname"]."</td>"; 
										} 


							echo "<td align=\"center\">".($row1["returnlap"]==NULL? "<span class='label label-danger'>ยังไม่คืน</span>" : DateThai($row1["returnlap"]) )."</td>"; 
							echo "<td align=\"center\">".($row1["returnlap"]==NULL? "" : setlate($row1["isLate"]) )."</td>"; 
							echo "<td align=\"center\">".$row1["cost"]."</td>"; 
							echo "<td align=\"center\">";
																			
										$sql4 = $db->prepare("SELECT * FROM permission WHERE Id LIKE :returnstaffId");
										$sql4->bindParam(':returnstaffId', $row1['returnstaffId'], PDO::PARAM_INT);
										$sql4->execute();
										$sql4->setFetchMode(PDO::FETCH_ASSOC);
										
										while ($row4 = $sql4->fetch()) {
											echo $row4["pname"].$row4["name"]." ".$row4["lastname"]; 
										} 
							echo "</td>";
							echo "</tr>";
						} ?>
					</tbody>
					</table>	
					  <a href="index.php" class="btn btn-primary">ย้อนกลับ</a>	
					</div>
			    </div>			    
			</div>
		<?php } ?>

         <?php include "../include/js.php"; ?>  
        <script src="../js/jquery.dataTables.min.js"></script> 
        <script>
        	$(document).ready(function() {
		    	$('#TableHistory').DataTable();
			} );
        </script>        
    </body>
</html>


