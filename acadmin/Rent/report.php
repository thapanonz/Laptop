<?php
require'../include/fpdf/fpdf.php';
require'../include/connect.php';
define('FPDF_FONTPATH','font/');
	
	function settype1($type){
		if($type=="student"){ return "นักศึกษา";}
		else if($type=="personnel"){ return "บุคลากร";}
	}		

	function DateThai($strDate)
	{
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

	
	$sql = $db->prepare ("SELECT * FROM reportlist");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sql->fetch()) {

	$n="\n";

	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->AddFont('angsa','B','angsab.php');
	$pdf->SetFont('angsa','B',20);
	$pdf->Cell(0,10,iconv('UTF-8','TIS-620','สัญญาเช่าเครื่องคอมพิวเตอร์'),0,1,"C");
	
	$starter = $pdf -> GetX();
	$get_x = $pdf -> GetX();
	$get_y = $pdf -> GetY();

	$A0 = 90; $A1 = 93; $A = 85; $B = 6; $C = 7; $C1 = 12; $D = 97; $E = 64;
 	$X1 = 50; $X2 = 50;

	$pdf->SetFont('angsa','',14);
	$pdf->Cell(0,4,iconv('UTF-8','TIS-620','สัญญาเช่าเลขที่     '.$row["Id_rent"]),0,1,"C");
	$pdf->Cell(0,9,iconv('UTF-8','TIS-620','_____________________________________________________________________________________________________'),0,1,"C");

	//$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
	
	$pdf -> SetLeftMargin(23);
	$pdf->MultiCell(0,7,iconv('UTF-8','TIS-620','          สัญญาฉบับนี้ทำขึ้น ณ ศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตหาดใหญ่
		เมื่อวันที่           '.DateThai($row["rentlap"]).'           ระหว่างศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตหาดใหญ่ ซึ่งต่อไปในสัญญานี้เรียกว่า "ผู้ให้เช่า" ฝ่ายหนึ่งกับ                 '.$row["prename"].$row["firstname"].' '.$row["lastname"].$n.'หมายเลขประจำตัวประชาชน       '.$row["Id_customer"].'        ประเภท       '.settype1($row["type"]).$n.'สังกัดคณะ/หน่วยงาน       '.$row["faculty"].'       รหัสนักศึกษา/บุคลากร       '.$row["passport"].$n.'เบอร์โทรศัพท์       '.$row["phone"].'       อีเมล์       '.$row["email"]),0,1);
	$pdf->Cell(0,2,iconv('UTF-8','TIS-620',''),0,1);	
	$pdf->MultiCell(0,7,iconv('UTF-8','TIS-620','ซึ่งต่อไปในสัญญานี้เรียกว่า "ผู้เช่า" อีกฝ่ายหนึ่ง คู่สัญญาได้ตกลงกันมีข้อความ ดังต่อไปนี้'.$n.'          ผู้เช่าได้เช่าเครื่องคอมพิวเตอร์ Notebook รหัสบาร์โค้ด       '.$row["nbCode"].'       Serial Number       '.$row["nbSerial"].$n.'ยี่ห้อ/รุ่น     '.$row["nbBrand"].'    และคุณลักษณะจำเพาะอื่นๆ ดังนี้'),0,1);
	
	$pdf->Cell(0,2,iconv('UTF-8','TIS-620',''),0,1);
	$pdf->MultiCell(164,7,iconv('UTF-8','TIS-620',$row["nbDetails"]),1,1);
	$pdf->Cell(0,2,iconv('UTF-8','TIS-620',''),0,1);
	$pdf->MultiCell(0,6,iconv('UTF-8','TIS-620','          ผู้เช่าได้ทำสัญญาเช่าและรับเครื่องไปเมื่อวันที่        '.DateThai($row["rentlap"]).'         มีระยะเวลาเช่า ______________ วัน
		โดยจะครบกำหนดส่งคืนในวันที่        '.DateThai($row["appointlap"]).'        ก่อนเวลา 13:00 น.'),0,1);

	$pdf->Cell(0,2,iconv('UTF-8','TIS-620',''),0,1);
	

	$pdf -> MultiCell(80,$B,iconv('UTF-8','TIS-620','วันเวลาให้เช่าและรับคืน'.$n.'(1) ให้เช่าวันจันทร์-ศุกร์ เวลา 09:00-16:00 น.'.$n.'(2) รับคืนวันจันทร์-ศุกร์ เวลา 09:00-13:00 น.'.$n.'(3) งดให้เช่าและรับคืนในวันหยุดราชการ วันหยุด'.$n.'นักขัตฤกษ์และวันหยุดตามประกาศของศูนย์คอมพิวเตอร์'.$n.'(4) ให้เช่าไม่เกิน 5 วัน'.$n.'(5) กรณีวันครบกำหนดคืนตรงกับวันหยุด'.$n.'ให้นำมาคืนก่อนวันหยุด'),1,"L");
	
	$get_x += $A0;
	$get_y += 110;

	$get_x += 7;				  // เว้นช่องว่าง
	$pdf -> setXY($get_x,$get_y); //

	$pdf -> MultiCell(80,$B,iconv('UTF-8','TIS-620','ความรับผิดชอบของผู้เช่า'.$n.'(1) ตัวเครื่องหรืออุปกรณ์ประกอบ ได้รับความเสียหาย'.$n.'ไม่สามารถ ใช้งานได้ ตามปกติ เช่น จอภาพแตก เครื่องตกหล่น'.$n.'ผู้เช่าต้องชดใช้ตามความเสียหายที่เกิดขึ้น'.$n.'(2) ตัวเครื่องหรืออุปกรณ์ประกอบสูญหาย ผู้เช่าต้องชดใช้'.$n.'เต็มมูลค่าของตัวเครื่องหรืออุปกรณ์ประกอบที่เช่า'.$n.'(3) ผู้เช่าทำลายพาร์ทิชั่นของฮาร์ดดิสก์ต้องชดใช้เงิน 300 บาท'.$n.'(4) สติ๊กเกอร์ของชิ้นส่วนอุปกรณ์มีการแกะหรือฉีกขาด ต้องชดใช้เงิน 500 บาท'),1,"L");
	$get_y += $E;



	$pdf -> MultiCell($B,$C,"",0);
	$get_x -= $D;				
	$pdf -> setXY($get_x,181); 

	$pdf -> SetLeftMargin(23);
	$pdf -> MultiCell(80,$B,iconv('UTF-8','TIS-620','รายการที่เช่า'.$n.'(1) เครื่องคอมพิวเตอร์ Notebook'.$n.'(2) Optical Mouse'.$n.'(3) AC Adapter'.$n.' (4) กระเป๋าเป้สะพาย'.$n.'(5) ปลั๊ก 2 ขา'),1,"L");
	
	$get_x += $A0;

	$get_x += $C;
	$get_y += $C1;				  
	$pdf -> setXY($get_x,199); 

	$pdf -> MultiCell(80,$B,iconv('UTF-8','TIS-620','อัตราค่าเช่าและค่าปรับ
		(1) ค่าเช่านักศึกษา 50 บาท/วัน บุคลากร 150 บาท/วัน'.$n.'(2) ค่าปรับวันละ 500 บาท หากคืนเครื่องหลังเวลาที่กำหนด'.$n.' (1 วัน หมายถึง รอบการเช่า ตั้งแต่วันที่เช่า ถึงเวลา 13:00 น. ของวันถัดไป)'),1,"L");

	
	$pdf->Cell(0,2,iconv('UTF-8','TIS-620',''),0,1);
	$pdf->MultiCell(0,6,iconv('UTF-8','TIS-620','          คู่สัญญาได้อ่านข้อความในสัญญาเช่า รวมทั้งประกาศศูนย์คอมพิวเตอร์ เรื่องข้อกำหนดการเช่าเครื่องคอมพิวเตอร์'.$n.'ชนิดพกพา (Notebook) และเข้าใจข้อความโดยละเอียดแล้ว ยอมรับเงื่อนไขทุกประการ จึงได้ลงลายมือชื่อไว้เป็นหลักฐาน'),0,1);

	$pdf->Cell(0,4,iconv('UTF-8','TIS-620',''),0,1);

	$pdf->MultiCell(0,6,iconv('UTF-8','TIS-620','ลงชื่อ _________________________ ผู้เช่า                                        ลงชื่อ _________________________ เจ้าหน้าที่ผู้ให้เช่า'.$n.'         '.$row["prename"].$row["firstname"].' '.$row["lastname"].'                                                                      '.$row["pname"].$row["name"].' '.$row["lastname1"]),0,1);
	$pdf->Cell(0,3,iconv('UTF-8','TIS-620',''),0,1);
	$pdf->MultiCell(0,7,iconv('UTF-8','TIS-620','ลงชื่อ _________________________ ผู้คืน                                        ลงชื่อ _________________________ เจ้าหน้าที่ผู้รับคืน'.$n.'                                                                                                              วันที่ _________________________'),0,1);

	        	

$pdf->Output();

		}
?>