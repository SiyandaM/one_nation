<?php 

/* Verification of signup/subscription form input.*/

      require_once '/header_meta.php';
      require_once '/logo_header.php';
	  

	  
	  $error = $user_name = $dob = $gender = $cell_no = $password = $repassword = $captcha = "";
      if (isset($_SESSION['user_name'])) destroySession();

      if (isset($_POST['user_name']))
          {
			// Removes any malicious characters that might be entered via form input.  
            $user_name = sanitizeString($_POST['user_name']);
            $password = sanitizeString($_POST['password']);
			$repassword = sanitizeString($_POST['repassword']);
			$dob = sanitizeString($_POST['dob']);
			$gender = sanitizeString($_POST['gender']);
			$cell_no = sanitizeString($_POST['cell_no']);
			$captcha = sanitizeString($_POST['captcha']);

               if ($user_name == "" || $password == "" || $repassword== ""|| $dob == "" || $gender == "" || $cell_no == "" || $captcha == "")
                 $error = "Not all fields were entered<br><br>";
               else if (($password !== $repassword)){
			     $error = "Passwords entered do not match <br><br>";
			   } else if (strtolower($captcha) != strtolower($_SESSION['captcha'])){
				 $error = "Entered wrong captcha string <br><br>";  
			   } else if (!preg_match('/^[a-z\d]{2,22}$/i', $user_name)) {
				   $error = "Username must only contain 2 or more alphabets<br><br>";
			   } else if (!preg_match('/^0[0-9]{9}/', $cell_no)) {
				   $error = "Cellphone number must start with zero and have 10 digits only.<br><br>";
			   }else if (!preg_match('/.{6,50}/', $password)) {
				   $error = "Password is too long.<br><br>";
			   }
			   else{
				   // hash of password to be added and earlier versions to be included
				   //$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                   $result = queryMysql("SELECT * FROM nation WHERE user_name='$user_name'");
                   
				   
				   /*######
				      To be removed since users will be allowed to have matching user names.
				      There must be another unique form entry so 2 or more users cannot have 
					  matching form entries.######
				   */
                   if ($result->num_rows)
                     $error = "That username already exists<br><br>";
                   else
                    {
                     queryMysql("INSERT INTO nation VALUES('', '$user_name', '$dob', '$gender', '$cell_no', '$password')");
                     die("<h4>Account created</h4>Please <a href='login.php'>Log in</a>.<br><br>");
                    }
                }
          }

?>
   <h3 class="error"> <?php echo "$error"."<br/>";?> </h3>
   
   <form class="form-horizontal subscribe-form" method="post" action="subscribe.php">
     <div class="form-group form-group-lg">
       <label for="user_name" class="col-md-2 control-label">Username</label>
	   <div class="col-md-10">
       <input type="text" class="form-control" id="user_name" name="user_name" pattern="^[a-zA-Z][a-zA-Z0-9]{2,22}" placeholder="Samual" required>
	  </div>
	 </div>
	 
	 <div class="form-group form-group-lg">
       <label for="dob" class="col-md-2 control-label">Date Of Birth</label>
	   <div class="col-md-10">
       <input type="date" class="form-control" id="dob" name="dob" required>
	  </div>
	 </div>

     <div class="form-group form-group-lg">
       <label for="gender" class="col-md-2 control-label">Gender</label>
	   <div class="col-md-10">
       <select class="form-control input-lg" id="gender" name="gender" placeholder="Select"required>
	      <option>Male</option>
          <option>Female</option>
	   </select>
	  </div>
	 </div>
     
     <div class="form-group form-group-lg">
        <label for="cell_no" class="col-md-2 control-label">Cellphone Number</label>
	    <div class="col-md-10">
        <input type="tel" class="form-control" id="cell_no" name="cell_no" pattern="^0[0-9]{9}" placeholder="0712345678" required>
	   </div>
	 </div>	 
  
 <div class="form-group form-group-lg ">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="6 characters or more i.e.cdrt23w" pattern=".{6,50}" required autocomplete="off">
    </div>
  </div>
  
  <div class="form-group form-group-lg">
    <label for="repassword" class="col-md-2 control-label">Re-Password</label>
    <div class="col-md-10">
      <input type="password" class="form-control" id="repassword" name="repassword" placeholder="6 characters or more i.e.cdrt23w" pattern=".{6,}" required autocomplete="off"/>
    </div>
  </div>
  
  <!--Captch image centred -->
  <img src="tools/showCaptcha.php" class="img-responsive captcha center-block" alt="captcha" /><br/>
   
    <div class="form-group form-group-lg">
       <label for="captcha" class="col-md-2 control-label">Enter above string</label>
	   <div class="col-md-10">
         <input type="text" class="form-control" id="captcha" name="captcha" required  autocomplete="off"/>
       </div> 
	</div>
 
    <div class="row">
    <div class="col-md-12">
     <button class="btn text-uppercase center-block links btn-lg active btn-block" type="submit">Create account</button>
    </div>
    </div>
     
   </form>
   
   
<?php require_once '/footer.php';?>