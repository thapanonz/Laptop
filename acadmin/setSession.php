<?php
//you should look into using PECL filter or some form of filtering here for POST variables
//$username = strtoupper($_POST["username"]); //remove case sensitivity on the username
$username = $_POST["username"];
$password = $_POST["password"];
$username = addslashes($username);
$password = addslashes($password);
//$formage = $_POST["formage"];

if (isset($_POST["btnSubmit"])) { //prevent null bind

	if ($username != NULL && $password != NULL){
		//include the class and create a connection
		//include (dirname(__FILE__) . "/src/adLDAP.php");
		include (dirname(__FILE__) . "/src/classes/adLDAPUsers.php");
        try {
		    $adldap = new adLDAP();		    		    
        }
        catch (adLDAPException $e) {
            echo $e; 
            exit();   
        }
		
		//authenticate the user
		//if ($adldap->authenticate($username, $password)){        
        //var_dump("sitthinai_usr_pwd||" . $username . $password);var_dump("<br>");//exit(0);        
        if ($adldap->authenticate($username, $password)){
        //if ($adldapuser->authenticate($username, $password)){
			
			//var_dump("sitthinai_adlap_authen||" . $adldap->authenticate($username, $password));
			var_dump("sitthinai_adlap_authen||");
			var_dump($adldap->authenticate($username, $password));
			echo "<br>";
			echo "<br>";
			echo "<br>";
			//exit(0);

			//establish your session and redirect

			session_start();
			
			$user=$username;

			//$adldapuser = new adLDAPUsers($adldap);
			//$ldapUser = $adldapuser->infoCollection($user);
			//var_dump($ldapUser);
			
			//"samaccountname","mail","memberof","department","displayname","telephonenumber","primarygroupid","objectsid", "physicalDeliveryOfficeName"
			$userinfo = $adldap->user()->info($user, array("samaccountname","mail","displayname"));

			////$userinfo = $adldap->user()->info("test", array("samaccountname","mail","displayname"));
			//echo $userinfo[0]["samaccountname"][0];

			$accname = $userinfo[0]["samaccountname"][0];
			if (!is_null($accname))
			{						
				$_SESSION['userperm'] = $userinfo[0]["samaccountname"][0];
				//$_SESSION['userlevel'] = $row['level'];
				session_write_close();
				header('Location: index.php');
			}
			else {
				//echo "account name is null";
				header('Location: login.php?error=1');		
			}
		}
		else{
			header('Location: login.php?error=4');	
		}
	}


?>
