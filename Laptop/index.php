<?php
	require "../include/connect.php";
	//Set Path
	$isSubfolder = true;
	$activepage = "laptop";
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
						<a href="addform.php" class="btn btn-info">เพิ่มรายการ</a>

		<br><br><br><table class="table table-striped table-bordered">
			<thead>
		      <tr>
		        <th>nbCode</th>
		        <th>nbStatus</th>		       	        
		      </tr>
		    </thead>
			<tbody>
		<?php
			$sql = $db->prepare("SELECT nbCode,nbStatus FROM notebook");
			$sql->execute();
			$result = $sql->fetchall();
			foreach($result as $row){
				echo "<tr>";
                echo "<td>" .$row["nbCode"]."</td>";
                echo "<td>" .$row["nbStatus"]."</td>";
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
