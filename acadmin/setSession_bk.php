<?
//you should look into using PECL filter or some form of filtering here for POST variables
$username = strtoupper($_POST["username"]); //remove case sensitivity on the username
$password = $_POST["password"];
$username = addslashes($username);
$password = addslashes($password);
//$formage = $_POST["formage"];
var_dump($_POST["btnSubmit"]);
if (isset($_POST["btnSubmit"])) { //prevent null bind

	if ($username != NULL && $password != NULL){
		//include the class and create a connection
		include (dirname(__FILE__) . "/src/adLDAP.php");
        try {
		    $adldap = new adLDAP();
        }
        catch (adLDAPException $e) {
            echo $e; 
            exit();   
        }
		
		//authenticate the user
		if ($adldap->authenticate($username, $password)){
			//establish your session and redirect

			session_start();
			require "include/connect.php";

			$user=$username;
			$sql = $db->prepare("SELECT user,level FROM permission WHERE user='".$user."'");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			if ($row = $sql->fetch()) { 
				$sql1= "UPDATE permission SET last_login = NOW() WHERE user = :user";
				$stmp = $db->prepare($sql1);
				$stmp->bindParam("user" , $_POST["username"]);
				if ($stmp->execute()) {
					$_SESSION['userperm'] = $user;
					$_SESSION['userlevel'] = $row['level'];
					session_write_close();
					header('Location: index.php'); 
				}
			}
			else {
				header('Location: login.php?error=1');		
			}
			
		}
		else{
			header('Location: login.php?error=4');	
		}
	}
}

?>
