<?php
if($_POST["cid"])
{
	require "../include/connect.php";
	$cid = $_POST["cid"];
	$sql = $db->prepare("SELECT * from customer WHERE Id = '".$cid."'");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	if ($row = $sql->fetch()) {	
	$cname = $row['prename']. $row['firstname']."  ". $row['lastname'];
	?>
	<h3><?=$cid?>: <?=$cname?></h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
			</tr>
		</tbody>
	</table>
	<?
	}
	else
	{
		?>
		<h4 class="text-danger">ไม่พบผู้ใช้</h4>
		<?
	}
}