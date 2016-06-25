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
	<title>Report Rent Print</title>
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
			$sql = $db->prepare ("SELECT *, DATEDIFF(appointlap, rentlap) AS days 
				                  FROM reportlist WHERE Id_rent=".$Id);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			if ($row = $sql->fetch()) { ?>
			<div style="">
			    <h2 style="text-align:center;">สัญญาเช่าเครื่องคอมพิวเตอร์</h2>
				<h3 style="text-align:center; ">สัญญาเช่าเลขที่&nbsp;&nbsp;<?php echo $row["Id_rent"] ?></h3>	
				<div style="text-align:center; margin-top:-20px;">____________________________________________________________________________________________</div>
			</div>
			<div>
		
			<p>สัญญาฉบับนี้ทำขึ้น ณ ศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตหาดใหญ่<br>
			เมื่อวันที่ 
			<span><?php echo DateThai($row["rentlap"]) ?></span> ระหว่างศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตหาดใหญ่ ซึ่งต่อไปในสัญญานี้เรียกว่า "ผู้ให้เช่า" ฝ่ายหนึ่งกับ 
			<span style="margin-left:25px;"><?php echo $row["prename"].$row["firstname"].' '.$row["lastname"] ?></span><br> หมายเลขประจำตัวประชาชน <span><?php echo $row["Id_customer"] ?></span>        ประเภท <span><?php echo settype1($row["type"]) ?></span>สังกัดคณะ/หน่วยงาน <span><?php echo $row["faculty"] ?></span>  รหัสนักศึกษา/บุคลากร  <span><?php echo $row["passport"] ?></span><br>เบอร์โทรศัพท์   <span><?php echo $row["phone"] ?></span>  อีเมล์ <span><?php echo $row["email"] ?></span></p>
			
			<p>ซึ่งต่อไปในสัญญานี้เรียกว่า "ผู้เช่า" อีกฝ่ายหนึ่ง คู่สัญญาได้ตกลงกันมีข้อความ ดังต่อไปนี้<br>ผู้เช่าได้เช่าเครื่องคอมพิวเตอร์ Notebook รหัสบาร์โค้ด  <span><?php echo $row["nbCode"] ?></span>  Serial Number <span><?php echo $row["nbSerial"] ?></span><br>ยี่ห้อ/รุ่น <span><?php echo $row["nbBrand"] ?></span>   และคุณลักษณะจำเพาะอื่นๆ ดังนี้ 

			<div style=" height: 67px; padding:0 7px 0 7px; border:1px solid #000;"><?php echo $row["nbDetails"] ?></div></p>
			
			<p>ผู้เช่าได้ทำสัญญาเช่าและรับเครื่องไปเมื่อวันที่ <span><?php echo DateThai($row["rentlap"]) ?></span>  มีระยะเวลาเช่า <span> <?php echo $row["days"] ?></span> วัน<br>โดยจะครบกำหนดส่งคืนในวันที่ <span><?php echo DateThai($row["appointlap"]) ?></span>  ก่อนเวลา 13:00 น.</p>		
		
	<div>
<div style="float:left; width:45%; height: 198px; padding:0 0 0 3px; border:1px solid #000;">
<pre>
<b>วันเวลาให้เช่าและรับคืน</b>
(1) ให้เช่าวันจันทร์-ศุกร์ เวลา 09:00-16:00 น.
(2) รับคืนวันจันทร์-ศุกร์ เวลา 09:00-13:00 น.
(3) งดให้เช่าและรับคืนในวันหยุดราชการ วันหยุด 
นักขัตฤกษ์และวันหยุดตามประกาศของศูนย์คอมพิวเตอร์
(4) ให้เช่าไม่เกิน 5 วัน
(5) กรณีวันครบกำหนดคืนตรงกับวันหยุด 
ให้นำมาคืนก่อนวันหยุด</pre>
			</div>
<div style="float:left; width:51%; height: 198px; padding:0 0 0 3px; margin-left: 10px; border:1px solid #000;">
<pre>
<b>ความรับผิดชอบของผู้เช่า</b>
(1) ตัวเครื่องหรืออุปกรณ์ประกอบ ได้รับความเสียหาย
ไม่สามารถ ใช้งานได้ ตามปกติ เช่น จอภาพแตก เครื่องตกหล่น
ผู้เช่าต้องชดใช้ตามความเสียหายที่เกิดขึ้น
(2) ตัวเครื่องหรืออุปกรณ์ประกอบสูญหาย ผู้เช่าต้องชดใช้
เต็มมูลค่าของตัวเครื่องหรืออุปกรณ์ประกอบที่เช่า
(3) ผู้เช่าทำลายพาร์ทิชั่นของฮาร์ดดิสก์ต้องชดใช้เงิน 300 บาท
(4) สติ๊กเกอร์ของชิ้นส่วนอุปกรณ์มีการแกะหรือฉีกขาด 
ต้องชดใช้เงิน 500 บาท</pre>
		</div>
	</div>

			<div>
<div style="float:left; width:45%; height: 133px; padding:0 0 0 3px; margin-top: 7px; border:1px solid #000;">
<pre>
<b>รายการที่เช่า</b>
(1) เครื่องคอมพิวเตอร์ Notebook
(2) Optical Mouse
(3) AC Adapter
(4) กระเป๋าเป้สะพาย
(5) ปลั๊ก 2 ขา</pre>
			</div>
<div style="float:left; width:51%; height: 133px; padding:0 0 0 3px; margin-top: 7px; margin-left: 10px; border:1px solid #000;">
<pre>
<b>อัตราค่าเช่าและค่าปรับ</b>
(1) ค่าเช่านักศึกษา 50 บาท/วัน บุคลากร 150 บาท/วัน
(2) ค่าปรับวันละ 500 บาท หากคืนเครื่องหลังเวลาที่กำหนด
(1 วัน หมายถึง รอบการเช่า ตั้งแต่วันที่เช่า 
ถึงเวลา 13:00 น. ของวันถัดไป)</pre>
			</div>
		</div>

		<p>คู่สัญญาได้อ่านข้อความในสัญญาเช่า รวมทั้งประกาศศูนย์คอมพิวเตอร์ เรื่องข้อกำหนดการเช่าเครื่องคอมพิวเตอร์<br> ชนิดพกพา (Notebook) และเข้าใจข้อความโดยละเอียดแล้ว ยอมรับเงื่อนไขทุกประการ จึงได้ลงลายมือชื่อไว้เป็นหลักฐาน</p>

	<div style="padding-top: 28px">
<div style="float:left; width:45%; height: 167px; padding:0 0 0 3px; border:0px solid #000;">
<pre style="padding-left: 5px;">
ลงชื่อ                                             
<div style="padding-top: 7px; padding-left: 20px;"><div style="background-color:#CCC; text-align: center; padding: 2px 0 2px 0"><?php echo $row["prename"].$row["firstname"].' '.$row["lastname"] ?></div style="background-color:#CCC; text-align: center;"></div><div style="padding-top: 4px; text-align:center">ผู้เช่า</div><div style="padding-top: 18px; padding-left: 20px; text-align:left">ลงชื่อ __________________________ ผู้คืน</div></pre>
			</div>
<div style="float:left; width:51%; height: 167px; padding:0 0 0 3px; margin-left: 10px; border:0px solid #000;">
<pre style="padding-left: 20px;">
ลงชื่อ                                        
<div style="padding-top: 7px; padding-left: 20px;"><div style="background-color:#CCC; text-align: center; padding: 2px 0 2px 0"><?php echo $row["pname"].$row["name"].' '.$row["lastname1"] ?></div style="background-color:#CCC; text-align: center;"></div><div style="padding-top: 4px; text-align:center">เจ้าหน้าที่ผู้ให้เช่า</div><div style="padding-top: 18px; padding-left: 20px; text-align:left">ลงชื่อ _________________________ เจ้าหน้าที่ผู้รับคืน</div><div style="padding-top: 17px; padding-left: 20px; text-align:left">วันที่ __________________________</div>
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