<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
require'../include/connect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Report Daily Print</title>
	<meta name="description" content="jQuery Print Area" />
	<meta name="keywords" content="jQuery Print Area" />
	<meta http-equiv="imagetoolbar" content="no" />
	<link href="../css/core.css" rel="stylesheet" media="screen" type="text/css" />
	<link href="../css/core.css" rel="stylesheet" media="print" type="text/css" />	
</head>
<body>

<div id="wrapper">
	<div id="content" >
 <?php	
		//$returnlap=$_GET["returnlap"];
		$sql = $db->prepare ("SELECT returnlap from rent where returnlap 
							BETWEEN (DATE_FORMAT(DATE_SUB('2016-06-26',INTERVAL 1 DAY) ,'%Y-%m-%d 13:00:00')) 
							AND (DATE_FORMAT('2016-06-26','%Y-%m-%d 12:59:00'))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		if ($row = $sql->fetch()) { ?> 
		<div>
		    <h2 style="text-align:left;">รายงานรายละเอียดการับคืนและยอดเงิน</h2>
			<h3 style="text-align:center; ">วันที่&nbsp;&nbsp;<?php echo $row["Id_rent"] ?></h3>	
		</div>
		<div>
			<table class="table">
			    <thead>
			      <tr>
			        <th>No</th>
			        <th>RentID</th>
			        <th>CustomerID</th>
			        <th>Code</th>
			        <th>RentDate</th>
			        <th>ReturnDate</th>
			        <th>Fee</th>
			        <th>Fine</th>
			        <th>Payment</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <td>1</td>
			        <td>Anna</td>
			      </tr>
			      <tr>
			        <td>2</td>
			        <td>Debbie</td>
			      </tr>
			      <tr>
			        <td>3</td>
			        <td>John</td>
			      </tr>
			    </tbody>
  </table>
		
		</div>	

	</div>
</div>
		
	<script src="../js/jquery-1.6.2.min.js"></script>
	<script src="../js/jquery.PrintArea.js_4.js"></script>
	<script src="../js/core.js"></script>
	<script type='text/javascript'>
        //<![CDATA[
        $(document).ready(function() {            
                //Print ele4 with custom options
                window.print();
            });
        </script>
</body>
</html>