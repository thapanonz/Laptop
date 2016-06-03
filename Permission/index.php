<?php
	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "permission";
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>จัดการสิทธิ์</title>
		<?php include "../include/css.php"; ?>
    </head>
    <body style="background-color:lightgrey;">
		<?php include "../include/banner.php"; ?>

		
			<?php include "../include/menu.php"; ?>	
		
		
			<div class="container">
				<div class="row">
					<div class="col-xs-4" style="margin-left: 30px">
					
						<h1>จัดการสิทธิ์</h1>
							<a href="addformpermission.php" class="btn btn-primary">เพิ่มผู้ดูแลระบบ</a>
			
			<br><br><table class="table table-striped table-bordered">
			<thead style="background-color: black; color: white">
		      <tr>
		        <th style="text-align: center">ชื่อผู้ใช้</th>
		        <th style="text-align: center">ประเภทผู้ใช้</th>	
		        <th style="text-align: center">แก้ไข/ลบ</th>	       	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT Id,user,level FROM permission");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {
				echo "<tr>";
                echo "<td>"; ?>             
                <div data-toggle="modal" data-target="#<?php echo $row["user"] ?>"><?php echo $row["user"] ?></div>

                <div class="modal fade" id="<?php echo $row["user"] ?>" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">จัดการสิทธิ์</h4>
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
                echo "<td>" .$row["level"]."</td>";
                echo "<td>";
            	   echo "<a href='editform.php?Id=".$row['Id']."'><i style='font-size:30px' class='fa fa-pencil' aria-hidden='true'></i></a>";               
            	   echo "<a href='submitpermissiondelete.php?Id=".$row['Id']."' onclick=\"return confirm('คุณต้องการลบ ชื่อผู้ใช้ นี้หรือไม่?');\"><i style='font-size:30px' class='fa fa-remove text-danger' aria-hidden='true'></i></a>";
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