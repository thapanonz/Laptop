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
		
		<style type="text/css">
			th {text-align: center;}
		</style>		
    </head>
    <body>
		<?php include "../include/banner.php"; ?>
		
			<?php include "../include/menu.php"; ?>	

			<div class="container">
				<div class="row">

					<div class="col-xs-7" style="margin-left: 30px">						

					<div class="col-xs-7" style="margin-left: 30px">						

						<h1>รายการเครื่องเช่า</h1>
						<a href="addform.php" class="btn btn-primary">เพิ่มรายการ</a>
		<br><br><table class="table table-bordered table-hover">
			<thead>
		      <tr bgcolor="#CCCCCC" >
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
                echo "<td align=\"center\">"; ?>             
                <a href="#" data-toggle="modal" data-target="#<?php echo $row["nbCode"] ?>"><?php echo $row["nbCode"] ?></a>

                <div class="modal fade" id="<?php echo $row["nbCode"] ?>" role="dialog">
				    <div class="modal-dialog">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">รายการเครื่องเช่า</h4>
				        </div>
				        <div class="modal-body">
					        <div class="row">
					        	<div class="col-sm-12" style="font-size: 17px; margin-left: 50px; text-align: left">
									<label>หมายเลขเครื่องเช่า:</label> <?php echo $row["nbCode"] ?><br>
									<label>ซีเรียลเครื่องเช่า:</label> <?php echo $row["nbSerial"] ?><br>
									<label>ยี่ห้อ/รุ่น:</label> <?php echo $row["nbBrand"] ?><br>
									<label>รายละเอียดของเครื่อง:</label><br> <textarea style="padding: 7px" readonly="readonly" rows="5" cols="50"><?php echo $row["nbDetails"] ?></textarea><br>
									<label>สถานะเครื่อง:</label> <?php echo setstatus($row["nbStatus"]) ?>
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
                echo "<td align=\"center\">" .setstatus($row["nbStatus"])."</td>";
                echo "<td align=\"center\">";
            	   echo "<a href='editform.php?Id=".$row['Id']."'><i style='font-size:25px' class='fa fa-pencil' aria-hidden='true'></i></a>";               
            	   echo " <a href='submitdelete.php?Id=".$row['Id']."' onclick=\"return confirm('คุณต้องการลบ รายการเครื่องเช่า นี้หรือไม่?');\"><i style='font-size:25px' class='fa fa-remove text-danger' aria-hidden='true'></i></a>";
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


