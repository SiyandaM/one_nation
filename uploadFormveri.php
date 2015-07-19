<?php 

/* Verification of upload form input minus video media.*/

      
      require_once 'functions.php';
   	  $errorulF = $active_channel = $channel_name = $video_title = $video_description = "";
     
	      // Removes any malicious characters that might be entered via form input.  
            $active_channel = sanitizeString($_POST['active_channel']);
           // $channel_name = sanitizeString($_POST['channel_name']);
			$video_title = sanitizeString($_POST['video_title']);
			$video_description = sanitizeString($_POST['video_description']);

               if ($active_channel == "" || $video_title == ""|| $video_description == "" ){
                 $errorulF = "Not all fields were entered.<br><br>";
		        }/* else{
				   
                   $result = queryMysql("SELECT * FROM _uploads_log WHERE channel_name ='$channel_name'");
               
                   if ($result->num_rows)
                    $errorulF = "That channel already exists enter another channel name.<br><br>";
                } */
          

?>