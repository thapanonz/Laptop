<?php
session_start();

			require "include/fnLogs.php";
			$menu = "Logout";
			$desc = $_SESSION['userperm']." ออกจากระบบ";
			logs($_SESSION['staffId'],$menu,$desc);

session_destroy();
header('Location: login.php');
?>