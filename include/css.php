 <?php 
 	if(isset($isSubfolder) && $isSubfolder == true) {
 		$_path = "../";
 	}
 	else{
 		$_path = "";
 	}
 ?>

        <link rel="stylesheet" type="text/css" href="<?=$_path?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=$_path?>css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?=$_path?>css/sidebar.css">  