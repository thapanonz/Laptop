<?php
	session_start();
	if(!isset($_SESSION['userperm'])) {
	header('Location: ../login.php?error=2'); 
	}
	
require'../include/connect.php';
	
	function settype1($type){
		if($type=="student"){ return "นักศึกษา";}
		else if($type=="personnel"){ return "บุคลากร";}
	}		

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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Report Receipt Print</title>
	<meta name="description" content="jQuery Print Area" />
	<meta name="keywords" content="jQuery Print Area" />
	<meta http-equiv="imagetoolbar" content="no" />
	<link href="../css/core.css" rel="stylesheet" media="screen" type="text/css" />
	<link href="../css/core.css" rel="stylesheet" media="print" type="text/css" />	
	<style>
		body {
			font-size:16px;
		}
		.receiptHeader{
			background-color:#CCC;
			text-align:center;
			font-size:24px;
			font-weight: bold;
			padding:10px 0 10px 0;
			margin-bottom:15px;
		}
		.detailBox{
			width:90%;
			height: 100px;
			border:1px solid #AAA;
			margin-left:auto;
			margin-right:auto;
			margin-top:10px;
		}
		.signName{
			margin-left: 300px;
			margin-top: 45px;
		}
	</style>
</head>
<body>

<div id="wrapper">
	<div id="content" >
		<?php	
		$Id=$_GET["Id"];
		$sql = $db->prepare ("SELECT * FROM receipt WHERE Id_rent=".$Id);
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		if ($row = $sql->fetch()) { ?>

			<div class="receiptHeader">
				ใบแทนใบเสร็จรับเงิน
			</div>
			<div style="text-align:right;">
				สัญญาเช่าเลขที่ <?=$row["Id_rent"]?>
			</div>
			<div style="text-align:right; margin-bottom:20px;">
				วันที่ออกใบแทนใบเสร็จรับเงิน&nbsp;&nbsp;<?php echo DateThai($row["returnlap"]) ?>
			</div>
			<div>
				<div style="margin-bottom: 15px;">ได้รับเงินจาก<span><?php echo $row["prename"].$row["firstname"].' '.$row["lastname"] ?></span></div>
				<div style="margin-bottom: 15px;">ประเภทลูกค้า<span><?php echo settype1($row["type"]) ?></span></div>
				<div style="margin-bottom: 15px;">สังกัดคณะ/หน่วยงาน <span><?php echo $row["faculty"] ?></span></div>
			</div>
			<div>
				<b>เป็นเงินดังรายการต่อไปนี้</b>
				<div class="detailBox">
					<table cellpadding="5" cellspacing="10" style="width:100%;">
						<tr>
							<td>ค่าเช่าเครื่องคอมพิวเตอร์ Notebook รหัสบาร์โค้ด <span><?php echo $row["nbCode"] ?></td>
							<td align="right"><?=($row["isFine"] == 1 ? 	$row["cost"] - $row["fee"] : $row["cost"])?> .-</td>
						</tr>
						<tr>
							<td>ค่าปรับ (ถ้ามี)</td>
							<td align="right"><?=($row["isFine"] == 1 ? 	$row["fee"] : 0)?> .-</td>
						</tr>
						<tr style="font-weight: bold;">
							<td>รวมเป็นเงินที่ต้องชำระทั้งสิ้น (บาท)</td>
							<td style="border-bottom:double 2px #AAA;" align="right"><?=$row["cost"]?> .-</td>
						</tr>
					</table>
				</div>
				<div>
					<div class="signName">
						<div>ลงชื่อผู้รับเงิน </div>
						<div style="margin: 25px 0 0 100px;"><span><?php echo $row["pname"].$row["name"].' '.$row["lastname1"] ?></span></div>
					</div>
				</div>
			</div>



		<?php } ?>
	</div>	
</div>
		
	<script src="../js/jquery-1.6.2.min.js"></script>
	<script src="../js/jquery.PrintArea.js_4.js"></script>
	<script src="../js/core.js"></script>
	<script type='text/javascript'>
        //<![CDATA[
        $(document).ready(function() {            
                //Print ele4 with custom options
                //window.print();
            });
        </script>
</body>
</html>