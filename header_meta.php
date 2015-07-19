<?php
/*
 Checks if user has any set session and loads html boilerplate. 
*/ 
  session_start();
  require_once 'functions.php';
  
  $userstr = ' (Guest)';

  if (isset($_SESSION['user_name']))
  {
    $user     = $_SESSION['user_name'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;
?>
<!DOCTYPE html>
<html>
 
<head>
<title>One</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/stylesheet.css">
  
</head>