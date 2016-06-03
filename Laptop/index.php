<?php
	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "laptop";

	function setstatus($status){
		if($status=="rdy"){ return "พร้อมใช้งาน";}
		else if($status=="notrdy"){ return "ไม่พร้อมใช้งาน";}
		else if($status=="rent"){ return "ถูกเช่า";}
	}	
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>รายการเครื่องเช่า</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body>
		<?php include "../include/banner.php"; ?>
		
			<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">
					<div class="col-xs-4" style="margin-left: 30px">						
						<h1>รายการเครื่องเช่า</h1>
						<a href="addform.php" class="btn btn-primary">เพิ่มรายการ</a>
		<br><br><table class="table table-striped table-bordered">
			<thead>
		      <tr>
		        <th>หมายเลขเครื่องเช่า</th>
		        <th>สถานะเครื่อง</th>	
		        <th>จัดการ</th>	       	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT Id,nbCode,nbSerial,nbBrand,nbDetails,nbStatus FROM notebook");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {
				echo "<tr>";
                echo "<td>"; ?>             
                <a data-toggle="modal" data-target="#<?php echo $row["nbCode"] ?>"><?php echo $row["nbCode"] ?></a>

                <div class="modal fade" id="<?php echo $row["nbCode"] ?>" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">รายการเครื่องเช่า</h4>
				        </div>
				        <div class="modal-body">
					        
					        




				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				        </div>
				      </div>

				      
				    </div>
				  </div>

                <?php echo "</td>";
                echo "<td>" .setstatus($row["nbStatus"])."</td>";
                echo "<td>";
            	   echo "<a href='editform.php?Id=".$row['Id']."'><i style='font-size:30px' class='fa fa-pencil' aria-hidden='true'></i></a>";               
            	   echo "<a href='submitdelete.php?Id=".$row['Id']."' onclick=\"return confirm('คุณต้องการลบ รายการเครื่องเช่า นี้หรือไม่?');\"><i style='font-size:30px' class='fa fa-remove text-danger' aria-hidden='true'></i></a>";
                echo "</td>";
                echo "</tr>";
			}
		?>
			</tbody>
		</table>
		</div>					
	</div>
</div>
						
        <?php include "../include/js.php"; ?>     
    </body>
</html>


