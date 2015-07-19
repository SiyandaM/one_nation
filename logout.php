<?php 
  require_once 'header_meta.php';
  require_once 'logo_header.php';
  
  if (isset($_SESSION['user_name']))
  {
    destroySession();
    echo "<div class='main'>You have been logged out. Please " .
         "<a href='index.php'>click here</a> to refresh the screen.<br><br><br><br>";
    require_once 'footer.php';
  }
  else echo "<div class='main'><br>" .
            "You cannot log out because you are not logged in " .
			"<a href='index.php'>click here</a> to login/signup.<br><br><br><br>";
        require_once 'footer.php';
?>

    <br><br></div>
  </body>
</html>
