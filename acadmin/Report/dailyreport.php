<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}

	require'../include/connect.php';

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

	function DateThai2($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
	}
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
		if (isset($_GET["returnlap"])) { 
			$returnlap=$_GET["returnlap"]; ?> 
		<div>
		    <h1 style="text-align:center;">รายงานรายละเอียดการรับคืนและยอดเงิน</h1>
			<h3 style="text-align:center; ">วันที่ 
			<?php 
				$date = new DateTime($returnlap);
				$date->sub(new DateInterval('PT24H0S'));
				echo DateThai($date->format('Y-m-d') . "\n");
			?> เวลา 13:00 น. ถึง วันที่ <?php echo  DateThai($returnlap) ?> เวลา 12:59 น.</h3>	
		</div>
		<br><div>
			<table cellspacing="0">	
			      <tr>
			        <th style="border-bottom:2px solid #000;"   width="5%" align="center">No</th>
			        <th style="border-bottom:2px solid #000;"  width="3%" align="center">RentID</th>
			        <th style="border-bottom:2px solid #000;"  width="25%" align="center">CustomerID</th>
			        <th style="border-bottom:2px solid #000;"  width="10%" align="center">Code</th>
			        <th style="border-bottom:2px solid #000;" width="20%" align="center">RentDate</th>
			        <th style="border-bottom:2px solid #000;" width="20%" align="center">ReturnDate</th>
			        <th style="border-bottom:2px solid #000;" width="7%" align="center">Fee</th>
			        <th style="border-bottom:2px solid #000;" width="8%" align="center">Fine</th>
			        <th  style="border-bottom:2px solid #000;" width="12%" align="center">Payment</th>
			      </tr>			   			   
			    
	<?php 
		$num=1; $sumfee=0; $sumfine=0; $sumpayment=0;
		$sql = $db->prepare ("SELECT * FROM dailyreport WHERE (returnlap BETWEEN 
							(DATE_FORMAT(DATE_SUB('".$returnlap."',INTERVAL 1 DAY) ,'%Y-%m-%d 13:00:00')) AND 
							(DATE_FORMAT('".$returnlap."','%Y-%m-%d 12:59:00')))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $sql->fetch()) { 
			      echo "<tr>";
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$num."</td>";
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$row["Id_rent"]."</td>";  
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$row["Id_customer"]."</td>"; 
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$row["nbCode"]."</td>"; 
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .DateThai1($row["rentlap"])."</td>";
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .DateThai1($row["returnlap"])."</td>"; 

			      $fee=$row["fee"];
			      $fine=$row["isFine"];
			      $payment=$row["cost"];

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
				    echo "<td align=\"right\">" .number_format($payment,2)."</td>"; 
			      }
			      echo "</tr>";

			      $sumfee=$sumfee+$fee;
			      $sumfine=$sumfine+$fine;
			      $sumpayment=$sumpayment+$payment;
			      $num++; 
			} 
			      echo "<tr>";
			      echo "<td style='border-top:2px double #000; padding-top:3px;'  colspan=\"6\">&nbsp;</td>"; 
			      echo "<td style='border-top:2px double #000; padding-top:3px;' align=\"right\">".number_format($sumfee,2)."</td>";
			      echo "<td style='border-top:2px double #000; padding-top:3px;' align=\"right\">".number_format($sumfine,2)."</td>";
			      echo "<td style='border-top:2px double #000; padding-top:3px;' align=\"right\">".number_format($sumpayment,2)."</td>";
			      echo "</tr>";
			      ?>			    
  			</table>		
		</div>	
	</div>
</div>
<?php } 
		else if (isset($_GET["startdate"]) && isset($_GET["enddate"])) { 
			$startdate=$_GET["startdate"];
			$enddate=$_GET["enddate"]; ?> 
		<div>
		    <h1 style="text-align:center;">รายงานรายละเอียดการรับคืนและยอดเงิน</h1>
			<h3 style="text-align:center; ">วันที่ <?php echo  DateThai2($startdate) ?> ถึง วันที่ <?php echo  DateThai2($enddate) ?></h3>	
		</div>
		<br><div>
			<table cellspacing="0">	
			      <tr>
			        <th style="border-bottom:2px solid #000;"   width="5%" align="center">No</th>
			        <th style="border-bottom:2px solid #000;"  width="3%" align="center">RentID</th>
			        <th style="border-bottom:2px solid #000;"  width="25%" align="center">CustomerID</th>
			        <th style="border-bottom:2px solid #000;"  width="10%" align="center">Code</th>
			        <th style="border-bottom:2px solid #000;" width="20%" align="center">RentDate</th>
			        <th style="border-bottom:2px solid #000;" width="20%" align="center">ReturnDate</th>
			        <th style="border-bottom:2px solid #000;" width="7%" align="center">Fee</th>
			        <th style="border-bottom:2px solid #000;" width="8%" align="center">Fine</th>
			        <th  style="border-bottom:2px solid #000;" width="12%" align="center">Payment</th>
			      </tr>			   			   
			    
	<?php 
		$num=1; $sumfee=0; $sumfine=0; $sumpayment=0;
		$sql = $db->prepare ("SELECT * FROM dailyreport WHERE (returnlap BETWEEN 
							(DATE_FORMAT('".$startdate."' ,'%Y-%m-%d %H:%i:00')) AND 
							(DATE_FORMAT('".$enddate."' ,'%Y-%m-%d %H:%i:00')))");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $sql->fetch()) { 
			      echo "<tr>";
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$num."</td>";
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$row["Id_rent"]."</td>";  
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$row["Id_customer"]."</td>"; 
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .$row["nbCode"]."</td>"; 
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .DateThai1($row["rentlap"])."</td>";
			      echo "<td style='padding:3px 0 3px 0;' align=\"center\">" .DateThai1($row["returnlap"])."</td>"; 

			      $fee=$row["fee"];
			      $fine=$row["isFine"];
			      $payment=$row["cost"];

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
				    echo "<td align=\"right\">" .number_format($payment,2)."</td>"; 
			      }
			      echo "</tr>";
			      
			      $sumfee=$sumfee+$fee;
			      $sumfine=$sumfine+$fine;
			      $sumpayment=$sumpayment+$payment;
			      $num++; 
			} 
			      echo "<tr>";
			      echo "<td style='border-top:2px double #000; padding-top:3px;'  colspan=\"6\">&nbsp;</td>"; 
			      echo "<td style='border-top:2px double #000; padding-top:3px;' align=\"right\">".number_format($sumfee,2)."</td>";
			      echo "<td style='border-top:2px double #000; padding-top:3px;' align=\"right\">".number_format($sumfine,2)."</td>";
			      echo "<td style='border-top:2px double #000; padding-top:3px;' align=\"right\">".number_format($sumpayment,2)."</td>";
			      echo "</tr>";
			      ?>			    
  			</table>		
		</div>	
	</div>
</div>
<?php } ?>

		
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