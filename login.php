<?php 
   require_once '/header_meta.php';
   require_once '/logo_header.php'; 
	  
  $error = $cell_no = $password = "";

  if (isset($_POST['cell_no']))
  {
    $cell_no = sanitizeString($_POST['cell_no']);
    $password = sanitizeString($_POST['password']);
    
    if ($cell_no == "" || $password == "")
        $error = "Not all fields were entered<br>";
    else
    {
      $result = queryMySQL("SELECT * FROM nation WHERE cell_no='$cell_no' AND password='$password'");

      if ($result->num_rows == 0)
      {
        $error = "<span>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
		$row = $result->fetch_array(MYSQLI_ASSOC);  
		$_SESSION['user_name'] = $row['user_name'];
        $_SESSION['cell_no'] = $cell_no;
        $_SESSION['pass'] = $password;
		$user = $row['user_name'];
        die("You are now logged in as ($user). Please <a href='homePage.php'>" .
            "click here</a> to continue.<br><br>");
		
      }
    }
  }
?>
    <?php
	  echo "$error"."<br/>";
	?>
    <form class="form-horizontal" method="post" action="login.php">
      <div class="form-group form-group-lg">
        <label for="cell_no" class="col-md-2 control-label">Cellphone Number</label>
	    <div class="col-md-10">
        <input type="tel" class="form-control" id="cell_no" name="cell_no"  value="" placeholder="071 234 567 8">
	   </div>
	  </div>
       <div class="form-group form-group-lg ">
       <label for="password" class="col-md-2 control-label">Password</label>
       <div class="col-md-10">
       <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
      </div>
      </div>
	
   
    <div class="row">
      <div class="col-md-12">
        <button class="btn text-uppercase center-block links btn-lg active btn-block" type="submit">send</button>
      </div>
    </div>
   
   </form>
   
   <div class="row">
    <div class="col-md-12">
     <button class="btn text-uppercase center-block links btn-lg active btn-block" type="submit">forgot password</button>
    </div>
   </div>
   
<?php require_once 'footer.php';?>
