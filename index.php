<?php
/*****

   This page merely directs one to the landing page or signup/login option page. 

 *****/ 
   require_once 'header_meta.php';
   require_once '/logo_header.php';
?>
 

<?php 
  if ($loggedin)
  {
	// This shows landing page ......
	
	echo "$userstr you are now logged in. Please <a href='mainHeader.php'>" .
    "click here</a> to continue.<br><br>";
    	
  }
  else {
  //This shows the page with signup/login options	  
  echo"<div class='row'>".
    "<div class='col-md-12'>".
    "<a href='subscribe.php'  class='btn btn-lg active text-uppercase text-center links center-block' role='button'>subscribe</a>".
	"</div>".
	"</div>".
    "<div class='row'>".
    "<div class='col-md-12'>".
    "<a href='login.php' class='btn btn-lg active links text-uppercase center-block' role='button'>login</a>".
    "</div>".
    "</div>";
  }	

?>   
<?php require_once '/footer.php';?>   