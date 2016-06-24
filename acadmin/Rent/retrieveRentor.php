<?php
	require "../include/connect.php";
	require "../include/fnDatethai.php";

	function setblacklist($isBlacklist){
		if($isBlacklist=="0"){ return "<span class='label label-success'>ปกติ</span>";}
		else if($isBlacklist=="1"){ return "<span class='label label-default'>บัญชีดำ</span>";}
	}	

	function setisLate($isLate){
		if($isLate=="0"){ return "<span class='label label-success'>ปกติ</span>";}
		else if($isLate=="1"){ return "<span class='label label-danger'>สาย</span>";}
	}	

	function setisFine($isFine){
		if($isFine=="0"){ return "<span class='label label-primary'>ไม่ปรับ</span>";}
		else if($isFine=="1"){ return "<span class='label label-danger'>ปรับ</span>";}
	}	


if($_POST["cid"]) {

	$cid = $_POST["cid"];
	$sql3 = $db->prepare("SELECT Id from customer WHERE Id = '".$cid."'");
	$sql3->execute();
	$sql3->setFetchMode(PDO::FETCH_ASSOC);
	if ($row3 = $sql3->fetch()) {	

		$sql = $db->prepare("SELECT * from historylist WHERE Id_customer = '".$cid."'");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);

		if ($row = $sql->fetch()) {	
			$cname = $row['prename'].$row['firstname']."  ".$row['lastname']; ?>	
				<?php	$sql2 = $db->prepare("SELECT isBlacklist from customer WHERE Id = '".$cid."'");
						$sql2->execute();
						$sql2->setFetchMode(PDO::FETCH_ASSOC);
						if ($row2 = $sql2->fetch()) { ?>
							<div class="row">
									
								<div class="col-lg-8">
								<h3><?php echo $cname ?></h3>
								</div>
								<div class="col-lg-4">
								<h3 align="right">สถานะ: <?php echo setblacklist($row2['isBlacklist']) ?></h3>
								</div>
							
							</div>
					<?php	} ?>

			<table class="table table-bordered table-hover text-center">
					<thead>
				      <tr style="color: #000000; background-color: #ccc;" >
				      <td>วันที่เช่า</td>
				      <td>วันที่คืน</td>
				      <td>หมายเลขเครื่องเช่า</td>
				      <td colspan="2">สถานะ</td>			      	             	        
				      </tr>
				    </thead>
					<tbody>		
						<?php 
							$sql1 = $db->prepare("SELECT * from historylist WHERE Id_customer = '".$cid."'");
							$sql1->execute();
							$sql1->setFetchMode(PDO::FETCH_ASSOC);
							while ($row1 = $sql1->fetch()) {
								echo "<tr>";
				                echo "<td>" .DateThai($row1["rentlap"])."</td>";
				                echo "<td>" .($row1["returnlap"]==NULL? "<span class='label label-warning'>ยังไม่คืน</span>" : DateThai($row1["returnlap"]) )."</td>";
				                echo "<td>" .$row1["nbCode"]."</td>";
				                echo "<td>" .($row1["isLate"]==NULL? "" : setisLate($row1["isLate"]) )."</td>";
				                echo "<td>" .($row1["isLate"]==NULL? "" : setisFine($row1["isFine"]) )."</td>";
				                echo "</tr>";
							}
						?>
					</tbody>
			</table>
		<?php } 
		else {
			$sql4 = $db->prepare("SELECT prename,firstname,lastname from customer WHERE Id = '".$cid."'");
			$sql4->execute();
			$sql4->setFetchMode(PDO::FETCH_ASSOC);
			if ($row4 = $sql4->fetch()) {	?>	
			<br><h3> <?php echo $row4['prename'].$row4['firstname']."  ".$row4['lastname']; ?>
			<br><br><span class="text-danger">ไม่พบข้อมูลเช่า</span></h3> 
			<?php }
		} 
	}
	else {
		return false; }
  } ?>

