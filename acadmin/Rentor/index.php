<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}

	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "listalluser";

	function settype1($type){
		if($type=="student"){ return "นักศึกษา";}
		else if($type=="personnel"){ return "บุคลากร";}
	}		

	function setblacklist($isBlacklist){
		if($isBlacklist=="0"){ return "<span class='label label-success'>ปกติ</span>";}
		else if($isBlacklist=="1"){ return "<span class='label label-default'>บัญชีดำ</span>";}
	}		
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>รายการผู้เช่าทั้งหมด</title>
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
					<div class="col-md-11" style="margin-left: 30px">						
						<h1>รายการผู้เช่า</h1>
						<a href="addform.php" class="btn btn-primary">เพิ่มข้อมูลผู้เช่า</a>
				<br><br><table class="table table-bordered table-hover" id="TableCustomer">
			<thead>
		      <tr bgcolor="#CCCCCC" >
		      	<th>ประเภท</th>
		        <th>เลขบัตรประชาชน</th>
		        <th>PSU Passport</th>
		        <th>ชื่อ - นามสกุล</th>		   
		        <th>คณะ/หน่วยงาน</th>
		        <th>ภาควิชา</th>
		        <th>ข้อมูลติดต่อ</th>
		        <th>สถานะ</th>
		        <th>จัดการ</th>		            	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT Id,passport,prename,firstname,lastname,type,faculty,department,address,phone,email,isBlacklist FROM customer");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {
				echo "<tr>";
				echo "<td>" .settype1($row["type"])."</td>";
                echo "<td>" .$row["Id"]."</td>";
                echo "<td>" .$row["passport"]."</td>";
                echo "<td>" .$row["prename"].$row["firstname"]."&nbsp;".$row["lastname"]."</td>";       
                echo "<td>" .$row["faculty"]."</td>";
                echo "<td>" .$row["department"]."</td>";
                echo "<td>"; 
        ?>  
				<div class="text-center">
				<a href="#" data-toggle="modal" data-target="#<?php echo $row["Id"] ?>" 
				>ติดต่อ</a></div>

                <div class="modal fade" id="<?php echo $row["Id"] ?>" role="dialog">
				    <div class="modal-dialog">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">ติดต่อ : <?php echo $row["prename"].$row["firstname"]."&nbsp;".$row["lastname"] ?></h4>
				        </div>
				        <div class="modal-body">
					        <div class="row">
					        	<div class="col-sm-11" style="font-size: 17px; margin-left: 50px; text-align: left">
									<label>เบอร์โทรศัพท์:</label> <?php echo $row["phone"] ?><br>
									<label>อีเมล์:</label> <?php echo $row["email"] ?><br>
									<label>ที่อยู่:</label><br> <textarea style="padding: 7px" readonly="readonly" rows="5" cols="50"><?php echo $row["address"] ?></textarea>
								</div>
							</div>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				        </div>
				      </div>      
				    </div>
				  </div>
		  <?php echo "</td>"; 		    
                echo "<td align='center'>".setblacklist($row["isBlacklist"])."</td>";
                echo "<td>"; ?>
                <div class="text-center">
            	<?php
            	echo "<a title='ประวัติการเช่า' href='history.php?Id=".$row['Id']."'><i style='font-size:20px' class='fa fa-file-text-o text-warning' aria-hidden='true'></i></a>";
            	   echo "&nbsp;&nbsp;<a title='แก้ไข' href='editform.php?Id=".$row['Id']."'><i style='font-size:22px' class='fa fa-pencil' aria-hidden='true'></i></a>";               
            	   echo "&nbsp;<a title='ลบ' href='submitdelete.php?Id=".$row['Id']."' onclick=\"return confirm('คุณต้องการลบ รายการผู้เช่า นี้หรือไม่?');\"><i style='font-size:22px' class='fa fa-remove text-danger' aria-hidden='true'></i></a>";
                echo "</td>"; ?>
				 </div>

              <?php echo "</tr>";
			}
		?>
			</tbody>
		</table>		
					</div>					
				</div>
			</div>
						
        <?php include "../include/js.php"; ?>  
        <script src="../js/jquery.dataTables.min.js"></script> 
        <script>
        	$(document).ready(function() {
		    	$('#TableCustomer').DataTable();
			} );
        </script> 
    </body>
</html>


