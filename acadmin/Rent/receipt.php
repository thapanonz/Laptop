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
		<h2 style="text-align:center;">ใบแทนใบเสร็จรับเงิน</h2>
		<h3 style="text-align:center; ">วันที่ออกใบแทนใบเสร็จรับเงิน&nbsp;&nbsp;<?php echo DateThai($row["returnlap"]) ?></h3><br><br>

		<p>ได้รับเงินจาก<span><?php echo $row["prename"].$row["firstname"].' '.$row["lastname"] ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาเช่าเลขที่<span><?php echo $row["Id_rent"] ?></span><br>ประเภทลูกค้า<span><?php echo settype1($row["type"]) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สังกัดคณะ/หน่วยงาน <span><?php echo $row["faculty"] ?></span><br><b>เป็นเงินดังรายการต่อไปนี้</b></p>	

		<div>
<div style="float:left; width:10%; height: 198px; padding:0 0 0 3px; border:0;"></div>
<div style="float:left; width:85%; height: 198px; padding:0 0 0 3px; margin-left: 10px; border:1px solid #000;">
<pre>
		<?php 
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
			      	} ?>
<br>ค่าเช่าเครื่องคอมพิวเตอร์ Notebook รหัสบาร์โค้ด<span><?php echo $row["nbCode"] ?></span> <span><?php echo $fee ?></span>
ค่าปรับ(ถ้ามี) <span><?php echo $fine ?></span>
รวมเป็นเงินที่ต้องชำระทั้งสิ้น(บาท) <div style="padding-right: 20px; text-align: right;"><span><?php echo $payment ?></span></div>
<?php } ?> 
</pre>
		</div>
	</div>

	<div style="padding-top: 28px">
<div style="float:left; width:45%; height: 167px; padding:0 0 0 3px; border:0px solid #000;"></div>
<div style="float:left; width:51%; height: 167px; padding:0 0 0 3px; margin-left: 10px; border:0px solid #000;">
<pre style="padding-left: 20px;">
ลงชื่อผู้รับเงิน                                        
<div style="padding-top: 11px; padding-left: 50px;"><div style="background-color:#CCC; text-align: center; padding: 2px 0 2px 0"><?php echo $row["pname"].$row["name"].' '.$row["lastname1"] ?></div></div>
</pre>
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
                window.print();
            });
        </script>
</body>
</html>