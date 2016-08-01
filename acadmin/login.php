<?php
	session_start();
	if(isset($_SESSION['userperm'])){
		header('Location: index.php');
	}
	require "include/connect.php";
	$activepage = "home";

	if(isset($_GET["error"])) {
		$error=$_GET["error"];
		if($error==1){
			$errormessage="ไม่พบผู้ใช้งาน";
		}
		if($error==2){
			$errormessage="กรุณเข้าสู่ระบบ";
		}
		if($error==3){
			$errormessage="คุณไม่มีสิทธิในการใช้งานส่วนนี้";
		}
		if($error==4){
			$errormessage="รหัสผ่านผิดพลาด";
		}
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>หน้าแรก</title>
		<?php include "include/css.php" ?>

		<style type="text/css" media="screen">
			.loginbox {
				margin-top: 80px;
				width: 100%;
				height: 450px;
				background-color: #FFF;
				border: solid 1px #2E13A1;
				border-radius: 5px;
			}
		</style>
    </head>
    <body>
		<?php include "include/banner.php"; ?>
		
			<div class="container">
				<div class="row">
					<div class="col-xs-6">						
				
				</div>
				<div class="col-xs-6">						
					<div class="loginbox" >
					<div class="container-fluid" style="padding: 50px 80px 0 80px;">

					<?php if(isset($error)) { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>พบข้อผิดพลาด</strong> <?=$errormessage ?>
					</div>
					<?php } ?>
					<form class="form form-horizontal" action="validation.php" method="POST" role="form">
					<!--<form class="form form-horizontal" action="setSession.php" method="POST" role="form">-->
						<legend>Login</legend> 
						<div class="form-group">
							<label>Username</label> <input required type="text" class="form-control" name="username">
						</div>
						<div class="form-group">
							<label>Password</label> <input required type="password" class="form-control" name="password">
						</div>
										
						<input type="submit" class="btn btn-primary" name="btnSubmit" value="Login">
					</form>
</div>
					</div>
				</div>
			</div>
			
		
        <?php include "include/js.php" ?>      
    </body>
</html>