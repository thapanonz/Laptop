<?php 
    require "acadmin/include/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ระบบเช่า/คืน NOTEBOOK</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="acadmin/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="acadmin/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="acadmin/css/magnific-popup.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="acadmin/css/creative.css" type="text/css">

    <link rel="stylesheet" type="text/css" href="acadmin/font-awesome/css/fonts/thsarabunnew.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">
    body,h1,h2,h3,h4,li,a,.x { 
        font-family: 'THSarabunNew', sans-serif; 
    }
.bg-primary{
    background-color:rgba(0,0,255,0.3);
    color: black;
}
.bg-primary2{
    background:#EEEEEE;
    color: black;
}
.bg-primary3{
    background:#EEEEEE;
    color: black;
}
</style>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top" style="font-family: 'THSarabunNew', sans-serif;">บริการเช่า-คืน NOTEBOOK</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">ข้อกำหนดการเช่า NOTEBOOK</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">รายละเอียดเครื่องเช่า</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">ภาพรวมของเครื่อง</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">ติดต่อสอบถาม</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>บริการเช่า-คืน NOTEBOOK</h1>
                <h2>ศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์</h2>
                <hr>
                <h3>เครื่องพร้อมให้บริการเช่าจำนวน 
                <?php 
                $sql = $db->prepare("SELECT COUNT(Id) AS sumlaptop FROM notebook WHERE nbStatus='rdy'");
                    $sql->execute();
                    $sql->setFetchMode(PDO::FETCH_ASSOC);
                    if ($row = $sql->fetch()) { ?>
                       <span class='label label-success' style="font-size: 35px; padding:0 10px 0 10px"> <?php echo $row["sumlaptop"] ?></span> 
                    <?php } ?>                 
                 เครื่อง</h3>
                <br><br><br><br><br><a href="#about" class="page-scroll btn btn-default btn-xl sr-button" style="font-family: 'THSarabunNew', sans-serif;">ข้อกำหนดการเช่า</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="section-heading text-center"><b>ข้อกำหนดการเช่า NOTEBOOK</b></h2>
                    <hr class="light">
                    <div>
                        <h3><b>หลักเกณฑ์การเช่า</b></h3>
                            <ol style="font-size: 18px">
                                <li>
                                    ผู้เช่าต้องเป็นนักศึกษาหรือบุคลากรในมหาวิทยาลัยสงขลานครินทร์เท่านั้น
                                </li>
                                <li>
                                    ผู้เช่าต้องแสดงบัตรประจำตัวประชาชนตัวจริง
                                </li>
                                <li>
                                    ให้เช่าคนละ 1 เครื่องต่อครั้ง
                                </li>
                            </ol>                    
                    </div>
                    <div>
                        <h3><b>วัน/เวลาให้เช่า-รับคืน</b></h3>
                            <ol style="font-size: 18px">
                                <li>
                                    <b>ให้เช่า</b>วันจันทร์ - วันศุกร์ ระหว่างเวลา 09:00 - 16:00 น.
                                </li>
                                <li>
                                    <b>รับคืน</b>วันจันทร์ - วันศุกร์ ระหว่างเวลา 09:00 - 13:00 น.
                                </li>
                            </ol>                       
                    </div>
                    <div>
                        <h3><b>อัตราค่าเช่า/ค่าปรับ</b></h3>
                            <ol style="font-size: 18px">
                                <li>
                                    นักศึกษา ค่าเช่าเครื่องละ 50 บาทต่อวัน
                                </li>
                                <li>
                                    บุคลากร ค่าเช่าเครื่องละ 150 บาทต่อวัน
                                </li>
                                <li>
                                    หน่วยงานภายใน ค่าเช่าเครื่องละ 150 บาทต่อวัน                                    
                                </li>
                                <li>
                                    หน่วยงานภายนอก ค่าเช่าเครื่องละ 300 บาทต่อวัน
                                </li>
                                    <b>*** กรณีส่งคืนหลังเวลาที่กำหนด คิดค่าปรับวันละ 500 บาท (สำหรับ นักศึกษาและบุคลากร)</b>
                                    <b>*** ต้องมีการทำหนังสือขอเช่า (สำหรับ หน่วยงานภายในและหน่วยงานภายนอก)</b>
                            </ol>                       
                    </div>
                    <br>
                    <div>
                        <h3><b>*** ความรับผิดชอบของผู้เช่า ***</b></h3>
                            <ol style="font-size: 18px">
                                <li>
                                    กรณีตัวเครื่อง หรืออุปกรณ์ประกอบได้รับความเสียหาย ไม่สามารถใช้งานได้ตามปกติ เช่น จอภาพแตก เครื่องตกหล่น ผู้เช่าต้องชดใช้ตามความเสียหายที่เกิดขึ้น
                                </li>
                                <li>
                                    กรณีตัวเครื่อง หรืออุปกรณ์สูญหายผู้เช่าต้องชดใช้เต็มมูลค่าของตัวเครื่อง หรืออุปกรณ์ประกอบที่เช่า
                                </li>
                                <li>
                                    ผู้เช่าทำลายพาร์ทิชั่นของฮาร์ดดิสก์ ต้องชดใช้เงิน 300 บาท
                                </li>
                                <li>
                                    สติกเกอร์ของชิ้นส่วนอุปกรณ์มีการแกะ หรือฉีกขาด ต้องชดใช้เงิน 500 บาท
                                </li>
                            </ol>
                    </div>
                    <hr class="light">
                    <div class="text-center">
                        <a href="#services" class="page-scroll btn btn-default btn-xl sr-button" style="font-family: 'THSarabunNew', sans-serif;">รายละเอียดเครื่องเช่า</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary2" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><b>รายละเอียดเครื่องเช่า</b><b></h2>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="col-sm-12 text-center">
                            <div id="comp-preview-box">
                                <div class="main-preview">
                                    <img src="acadmin\imgs\Lenovo G4080.png" alt="Lenovo G40" width="320"/>
                                    <h3><b>Lenovo G40</b></h3>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div class="col-sm-6">
                        <div class="comp-spec-info"><br><br>
                            <b><h5> - Processor :</b> Intel Core i7-5500U (2.40 - 3.00 GHz)<br><br> 
                            <b> - Graphic Card :</b> AMD Radeon R5 M230 (2GB GDDR3)<br><br> 
                            <b> - Main Memory :</b> 8 GB DDR3L<br><br> 
                            <b> - Hard Disk Drive :</b> 1 TB 5400 RPM<br><br> 
                            <b> - Display :</b> 14 inch (1366x768) HD<br><br>
                            <b> - Wireless Lan :</b> 802.11 b/g/n<br><br>
                            <b> - Operating System :</b> Windows 8.1 Professional (64 bit)</h5>
                        </div>
                    </div>
            </div>
         
                <hr class="primary">
            <br>
            <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><b>อุปกรณ์ประกอบ</b></h2>
                    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row"> 
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\equipment\Mouse.png" alt="Mouse" width="150px" height="150px" />
                        <h3>Mouse</h3>
                    </div>
                </div>              
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\equipment\Adapter.png" alt="Mouse" width="250px" height="100px" style="margin-top: 50px;" />
                        <h3>Adapter</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\equipment\Spark.png" alt="Mouse" width="150px" height="150px" />
                        <h3>Plug</h3>
                    </div>
                </div>
            </div>
        </div>
        <br>
            <hr class="primary">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><b>ซอฟต์แวร์</b></h2>
                    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\Windows 8.1 Logo.png" alt="OS Window 8.1" width="60px" height="60px" />
                        <h5>Windows 8.1 Professional</h5>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\microsoft office 2013-logo.png" alt="MS-Office" width="60px" height="60px" />
                        <h5>Microsoft Office Professional Plus 2013</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\Adobe Acrobat Reader DC logo.png" alt="Adobe Acrobat Reader DC" width="60px" height="60px" />
                        <h5>Adobe Acrobat Reader DC</h5>
                    </div>
                </div>              
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\photoscape-logo.PNG" alt="Photoscape" width="60px" height="60px" />
                        <h5>Photoscape</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\google chrome logo.png" alt="Google Chrome" width="60px" height="60px" />
                        <h5>Google Chrome</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\mozilla firefox logo.png" alt="Mozilla Firefox" width="60px" height="60px" />
                        <h5>Mozilla Firefox</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\7 zip logo.png" alt="7 zip" width="60px" height="60px" />
                        <h5>7 zip</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <img src="acadmin\imgs\Software_logo\vlc logo.png" alt="vlc" width="60px" height="60px" />
                        <h5>VLC media player</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="no-padding bg-primary" id="portfolio">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <br><br><h2 class="section-heading"><b>ภาพรวมของเครื่อง</b><b></h2>
                        <hr class="primary">
                    </div>
                </div>
            </div>
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="acadmin\imgs/portfolio/fullsizes/1.jpg" class="portfolio-box">
                        <img src="acadmin\imgs/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    
                                </div>
                                <div class="project-name">
                              
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="acadmin\imgs/portfolio/fullsizes/2.jpg" class="portfolio-box">
                        <img src="acadmin\imgs/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                 
                                </div>
                                <div class="project-name">
                           
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="acadmin\imgs/portfolio/fullsizes/3.jpg" class="portfolio-box">
                        <img src="acadmin\imgs/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                         
                                </div>
                                <div class="project-name">
                               
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="acadmin\imgs/portfolio/fullsizes/4.jpg" class="portfolio-box">
                        <img src="acadmin\imgs/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                          
                                </div>
                                <div class="project-name">
                              
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="acadmin\imgs/portfolio/fullsizes/5.jpg" class="portfolio-box">
                        <img src="acadmin\imgs/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                           
                                </div>
                                <div class="project-name">
                           
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="acadmin\imgs/portfolio/fullsizes/6.jpg" class="portfolio-box">
                        <img src="acadmin\imgs/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                              
                                </div>
                                <div class="project-name">
                                 
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-primary3" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading"><b>ติดต่อสอบถาม</b></h2>
                    <hr class="primary">
                    <p>ศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์ อำเภอหาดใหญ่ จังหวัดสงขลา 90110</p>
                </div>
                <div class="col-lg-4 text-center">
                    <a class="fa fa-map-marker fa-4x sr-contact" href="https://www.google.co.th/maps/place/ศูนย์คอมพิวเตอร์+มหาวิทยาลัยสงขลานครินทร์+(Computer+Center)/@7.0091004,100.4983552,16.25z/data=!4m5!3m4!1s0x304d29a51a0f6199:0x321018be7a59ffe5!8m2!3d7.0089158!4d100.4979367?hl=th" target="_blank"></a>
                    <p><p>ที่ตั้ง</p></p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-phone fa-4x sr-contact"></i>
                    <p><br>โทร. 0-7428-2101
                    <br>โทรสาร. 0-7428-2111</p>
                   
                </div>
                <div class="col-lg-4 text-center">
                    <a class="fa fa-facebook fa-4x sr-contact" style="color: blue" href="https://www.facebook.com/ccserve" target="_blank"></a>
                    <p><p>กลุ่มงานบริการวิชาการ ศูนย์คอมพิวเตอร์ ม.อ.</p><p>
                </div>
            </div>
        </div>
    </section>
    <section class="footer" style="height: 5px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    Copyright © 2016 ศูนย์คอมพิวเตอร์ มหาวิทยาลัยสงขลานครินทร์.
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="acadmin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="acadmin/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="acadmin/js/scrollreveal.min.js"></script>
    <script src="acadmin/js/jquery.easing.min.js"></script>
    <script src="acadmin/js/jquery.fittext.js"></script>
    <script src="acadmin/js/jquery.magnific-popup.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="acadmin/js/creative.js"></script>

</body>

</html>
