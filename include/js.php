 <?php 
 	if(isset($isSubfolder) && $isSubfolder == true) {
 		$_path = "../";
 	}
 	else{
 		$_path = "";
 	}
 ?>	
		<script src="<?=$_path?>js/jquery.min.js"></script>
        <script src="<?=$_path?>js/bootstrap.min.js"></script>
        <script src="<?=$_path?>js/sidebar.js"></script> 