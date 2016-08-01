<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}

	require'../include/connect.php';	
	
	$xls_filename = 'Monthreport_'.date('d-m-Y').'.xls'; 
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");

	function DateThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	function DateThai1($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("m",strtotime($strDate));
		$strDay= date("d",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		return "$strDay/$strMonth/$strYear $strHour:$strMinute";
	}
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report Daily Print</title>
<style>
table, th {
     text-align: center;}
</style>
</head>
<body>
		
		<?php $startdate1=$_GET["startdate1"];
			  $enddate1=$_GET["enddate1"]; ?>
			
			<div align=center x:publishsource="Excel">		  
			<b>รายงานสรุปยอดการเช่าเครื่องคอมพิวเตอร์ Notebook</b><br>
		<b>วันที่ <?php echo  DateThai($startdate1) ?> ถึง วันที่ <?php echo  DateThai($enddate1) ?></b><br><br>
			
			  <table x:str border=1 cellpadding=0 cellspacing=1 style="border-collapse:collapse">
			      <tr>
			        <th>No</th>
			        <th>RentID</th>
			        <th>CustomerID</th>
			        <th>Code</th>
			        <th>RentDate</th>
			        <th>ReturnDate</th>
			        <th>Fee</th>
			        <th>Fine</th>
			        <th >Payment</th>
			        <th>Day</th>
			      </tr>			   			   
			    
	<?php 
		$num=1; $sumfee=0; $sumfine=0; $sumpayment=0; $sumday=0;
		$sql = $db->prepare ("SELECT *, DATEDIFF(returnlap, rentlap) AS days 
							FROM dailyreport WHERE (returnlap BETWEEN 
							(DATE_FORMAT('".$startdate1."' ,'%Y-%m-%d 00:00:00')) AND 
							(DATE_FORMAT('".$enddate1."' ,'%Y-%m-%d 23:59:00')))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $sql->fetch()) { 
			      echo "<tr>";
			      echo "<td align=\"center\">" .$num."</td>";
			      echo "<td align=\"center\">" .$row["Id_rent"]."</td>";  
			      echo "<td align=\"center\">" .$row["Id_customer"]."</td>"; 
			      echo "<td align=\"center\">" .$row["nbCode"]."</td>"; 
			      echo "<td align=\"center\">" .DateThai1($row["rentlap"])."</td>";
			      echo "<td align=\"center\">" .DateThai1($row["returnlap"])."</td>"; 

			      $fee=$row["fee"];
			      $fine=$row["isFine"];
			      $payment=$row["cost"];
			      $day=$row["days"];

			      if(isset($row["fee"])) {
				      	if($fine==0) {
				      		$fee=$row["cost"];
				      		$fine=0;
				      		$payment=$row["cost"];
				      	}
				      	else if($fine==1) {
				      		$fee=$row["cost"]-$row["fee"];
				      		$fine=$row["fee"];
				      		$payment=$row["cost"];
				      	}
				    echo "<td align=\"right\">" .$fee."</td>"; 
				    echo "<td align=\"right\">" .$fine."</td>"; 
				    echo "<td align=\"right\">" .$payment."</td>"; 
			      }
			      echo "<td align=\"center\">" .$row["days"]."</td>"; 
			      echo "</tr>";
			      
			      $sumfee=$sumfee+$fee;
			      $sumfine=$sumfine+$fine;
			      $sumpayment=$sumpayment+$payment;
			      $sumday=$sumday+$day;
			      $num++; 
			} 
			      echo "<tr>";
			      echo "<td colspan=\"6\">&nbsp;</td>"; 
			      echo "<td align=\"right\">".number_format($sumfee,2)."</td>";
			      echo "<td align=\"right\">".number_format($sumfine,2)."</td>";
			      echo "<td align=\"right\">".number_format($sumpayment,2)."</td>";
			      echo "<td align=\"center\">".$sumday."</td>";
			      echo "</tr>"; 
			      ?>			    
  			</table>	
		</div>
	<script>
	window.onbeforeunload = function(){return false;};
	setTimeout(function(){window.close();}, 10000);
	</script>
</body>
</html>