<?php 

require_once 'header_meta.php';

// restricts unsigned users from using the site. 
//if (!$loggedin) die();

require_once 'logo_header.php';
?>
 
  <button type="button" class="btn btn-default center-block">
     <a href="#"><span class="glyphicon glyphicon-user"></span><?php echo" $user";?></a>
   </button><br/>
   
 <div class="btn-group btn-group-sm"> 
   <button type="button" class="btn btn-default"><a href="homePage.php">Home</a></button>
   
   <button type="button" class="btn btn-default"> <!--glyphicon-inbox-->
     <a href="#"><span class="glyphicon glyphicon-envelope"> 1</span></a>
   </button>
   <button type="button" class="btn btn-default">
     <a href="file-upload.php"><span class="glyphicon glyphicon-upload"></span>Upload</a>
   </button>
   <button type="button" class="btn btn-default"><a href ="logout.php">Logout</a></button>    
   <br/><br/>
</div>  
  <div> 
    <form class="" role="form"> 
     <div class="input-group"> 
       <input type="text" class="form-control" placeholder="Enter Search Key...."> 
	   <span  class="glyphicon glyphicon-search input-group-addon" role="button"></span>
     </div> 
  </form>
 </div>
 <br/>
 <br/> 

<!--   <button type="button" class="btn btn-default btn-sm"> 
     <span class="glyphicon glyphicon-user"></span> User 
   </button>
   
   <button type="button" class="btn btn-default btn-sm"> 
     <span class="glyphicon glyphicon-search"></span> search 
   </button>
   
   <button type="button" class="btn btn-default btn-sm"> 
     <a href="#"><span class="glyphicon glyphicon-upload"></span> upload </a> 
   </button>
   
   <button type="button" class="btn btn-default btn-sm"> 
     <a href="#"><span class="glyphicon glyphicon-download"></span> download </a> 
   </button>
   
   <ul class="nav nav-pills nav-justified">  
    <li><a>home</a></li>
     
   </ul>
 -->