<?php
   require_once 'functions.php';
   
   if (isset($_POST['user_name'])){
	   
	   $user_name = sanitizeString($_POST['user_name']);
	   
	    if (!preg_match('/^[a-z\d]{2,22}$/i', $user_name)){
			
			echo  "<span>&nbsp;&#x2718; " .
            "This username is taken</span>";
		}else
			echo "<span>&nbsp;&#x2714; " .
           "This username is available</span>";
   }


?>