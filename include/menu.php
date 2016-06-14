 <?php 
 	if(isset($isSubfolder) && $isSubfolder == true) {
 		$_path = "../";
 	}
 	else{
 		$_path = "";
 	}

 ?>

<nav class="navbar navbar-inverse sidebar" role="navigation">	
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a class="navbar-brand" href="#">หัวข้อ</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="<?=($activepage == 'home') ? 'active' : '';?>"><a href="<?=$_path?>index.php">หน้าแรก<span style="font-size:20px;" class="pull-right hidden-xs showopacity fa fa-home"></span></a></li>		
				<li class="dropdown <?=($activepage == 'listallrent' || $activepage == 'record' || $activepage == 'return') ? 'open' : '';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">รายการเช่า <span class="caret"></span><span style="font-size:20px;" class="pull-right hidden-xs showopacity fa fa-bullhorn"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="<?=($activepage == 'listallrent') ? 'active' : '';?>"><a href="<?=$_path?>rent/index.php">รายการทั้งหมด</a></li>						
						<li class="<?=($activepage == 'record') ? 'active' : '';?>"><a href="<?=$_path?>rent/add.php">บันทึกรายการเช่า</a></li>
						<li class="<?=($activepage == 'return') ? 'active' : '';?>"><a href="<?=$_path?>rent/return.php">บันทึกการคืน</a></li>										
					</ul>
				</li>	
				<li class="<?=($activepage == 'laptop') ? 'active' : '';?>"><a href="<?=$_path?>laptop/index.php">รายการเครื่องเช่า<span style="font-size:20px;" class="pull-right hidden-xs showopacity fa fa-tasks"></span></a></li>	
				<li class="dropdown <?=($activepage == 'listalluser' || $activepage == 'history' ) ? 'open' : '';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">ข้อมูลผู้เช่า <span class="caret"></span><span style="font-size:20px;" class="pull-right hidden-xs showopacity fa fa-folder-open"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="<?=($activepage == 'listalluser') ? 'active' : '';?>"><a href="<?=$_path?>rentor/index.php">รายการทั้งหมด</a></li>						
						<li class="<?=($activepage == 'history') ? 'active' : '';?>"><a href="<?=$_path?>rentor/history.php">ตรวจสอบประวัติ</a></li>									
					</ul>
				</li>	
				<li class="dropdown <?=($activepage == 'dailyreport' || $activepage == 'periodreport' ) ? 'open' : '';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงานสรุป <span class="caret"></span><span style="font-size:20px;" class="pull-right hidden-xs showopacity fa fa-th-list"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li class="<?=($activepage == 'dailyreport') ? 'active' : '';?>"><a href="<?=$_path?>report/daily.php">สรุปรายวัน</a></li>						
						<li class="<?=($activepage == 'periodreport') ? 'active' : '';?>"><a href="<?=$_path?>report/period.php">สรุปตามช่วงเวลา</a></li>	
					</ul>
				</li>	
				<li class="<?=($activepage == 'permission') ? 'active' : '';?>"><a href="<?=$_path?>permission/index.php">จัดการสิทธิ์<span style="font-size:20px;" class="pull-right hidden-xs showopacity fa fa-user"></span></a></li>												
			</ul>
		</div>
	</div>
</nav>