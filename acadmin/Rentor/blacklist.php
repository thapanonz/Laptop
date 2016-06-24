<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}

	require "../include/connect.php";
	require "../include/fnDatethai.php";

	//Set Path
	$isSubfolder = true;
	$activepage = "blacklist";

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
        <title>ผู้เช่าบัญชีดำ</title>
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
					<div class="col-xs-6" style="margin-left: 30px">						
						<h1>ผู้เช่าบัญชีดำ</h1>
						
		<br><table class="table table-bordered table-hover" id="TableBlacklist">
			<thead>
		      <tr bgcolor="#CCCCCC" >
		        <th>เลขบัตรประชาชน</th>
		        <th>ชื่อ - นามสกุล</th>	
		        <th>สาย</th>	 
		        <th>ปรับ</th>  	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT * FROM blacklist");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {
				echo "<tr>";
				echo "<td align=\"center\">" .$row["Id_customer"]."</td>";  
				echo "<td align=\"center\">" .$row["prename"].$row["firstname"]." ".$row["lastname"]."</td>";   
				echo "<td align=\"center\">" .$row["sumlate"]."</td>";  
				echo "<td align=\"center\">" .$row["sumfine"]."</td>";  
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
		    	$('#TableBlacklist').DataTable();
			} );
        </script> 
    </body>
</html>


