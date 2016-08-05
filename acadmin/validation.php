<?php

$user = $_POST["username"];
$pass = $_POST["password"];
$username = addslashes($user);
$password = addslashes($pass);
//$formage = $_POST["formage"];

$personnel = 'Staffs';
$office = 'ฝ่ายฝึกอบรม ศูนย์คอมพิวเตอร์';


if (isset($_POST["btnSubmit"])) { //prevent null bind

	if ($username != NULL && $password != NULL){		

	session_start();
	require "include/connect.php";

	//$user=$_POST["username"];

	$sql = $db->prepare("SELECT Id,user,level,pname,name,lastname FROM permission WHERE user='".$user."'");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	if ($row = $sql->fetch()) { 
		$sql1= "UPDATE permission SET last_login = NOW() WHERE user = :user";
		$stmp = $db->prepare($sql1);
		$stmp->bindParam("user" , $_POST["username"]);
		if ($stmp->execute()) {
			$_SESSION['staffId'] = $row['Id'];
			$_SESSION['userperm'] = $user;
			$_SESSION['userlevel'] = $row['level'];
			$_SESSION['userfullname'] = $row['pname'].$row['name']." ".$row['lastname'];

			//var_dump(gettype($row['level']));
			//exit(0);

			// Log Statment
			require "include/fnLogs.php";
			$menu = "Login";
			$desc = $_SESSION['userperm']." เข้าสู่ระบบ";
			logs($_SESSION['staffId'],$menu,$desc);

			session_write_close();
			header('Location: index.php'); 
		}
	}
	else {

		//include the class and create a connection
		include (dirname(__FILE__) . "/src/adLDAP.php");		

        try {
		    $adldap = new adLDAP();		    		   
        }
        catch (adLDAPException $e) {
            echo $e;
            header('Location: login.php?error=1');
            exit();   
        }

        if ($adldap->authenticate($username, $password)){
        	
        	//$userinfo = $adldap->user()->info($user, array("samaccountname","mail","memberof","department","displayname","telephonenumber","primarygroupid","objectsid", "physicaldeliveryofficename","description","personaltitle"));
        	//var_dump($userinfo); exit(0);
        				
        	$userinfo = $adldap->user()->info($user, array("samaccountname","personaltitle","description","physicaldeliveryofficename"));
        	        	
			$accname = $userinfo[0]["samaccountname"][0];
			$allname = $userinfo[0]["description"][0];
			$fullname = $userinfo[0]["personaltitle"][0].$userinfo[0]["description"][0];
			$officename = $userinfo[0]["physicaldeliveryofficename"][0];
			$dnTxt = $userinfo[0]["dn"];			

			if (!is_null($accname))
			{
				/*
				if (strpos($dnTxt, $personnel) !== false) {
					echo $dnTxt; echo "<br>";
				    echo 'Is Staffs'; echo "<br>";
				}
				else {echo 'Is PSU'; echo "<br>";}

				if (strpos($officename, $office) !== false) {
					echo $officename; echo "<br>";
				    echo 'Is in KBW'; echo "<br>";
				}
				else {echo 'Is in PSU'; echo "<br>";}
				

				if ((strpos($dnTxt, $personnel) !== false) 
					&& (strpos($officename, $office) !== false)) {
					echo 'Is Staffs and Is in KBW'; echo "<br>";
				}
				exit(0);
				*/

				if ((strpos($dnTxt, $personnel) !== false) 
					&& (strpos($officename, $office) !== false))
				{

					$_SESSION['staffId'] = 99;
					$_SESSION['userperm'] = $accname;				
					$_SESSION['userlevel'] = "user";
					$_SESSION['userfullname'] = $fullname;


					// Add to table: StaffOrAdmin
					require "include/fnStaffOrAdmin.php";
					$arr_allname = split(" ", $allname);
					$id = 99;
					$staffUser = $accname;
					$name = $arr_allname[0];
					$lastname = $arr_allname[1];

					//echo $id . " | " . $staffUser . " | " . $name. " | " . $lastname; 
					//exit(0);

					$isExisting = isExist($id,$staffUser);					
					//echo $isExisting;exit(0);
					if ($isExisting == 0) {
						add($id,$staffUser,$name,$lastname);
					}

					
					// Log Statment
					require "include/fnLogs.php";
					$menu = "Login";
					$desc = $_SESSION['userperm']." เข้าสู่ระบบ";

					//echo $_SESSION['staffId'] . " | " . $menu . " | " .$desc; 
					//exit(0);

					logs($_SESSION['staffId'],$menu,$desc);


					session_write_close();
					header('Location: index.php');
				}
				else {				
					header('Location: login.php?error=3');	
				}	
			}
		}
		else {				
			header('Location: login.php?error=4');		
		}	
	}
}
}
?>


