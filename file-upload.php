<?php
 require_once 'mainHeader.php';
 if (!$loggedin) die();
?>

<?php

####################################################################
# File Upload Form 1.1
####################################################################

####################################################################

####################################################################
#  SETTINGS START
####################################################################

// Folder to upload files to. Must end with slash / ......changed this to local upload file
define('DESTINATION_FOLDER','C:/wamp/www/frontendFinal/upload/');

// Maximum allowed file size, Kb
// Set to zero to allow any size
define('MAX_FILE_SIZE', 10*1024);

// Upload success URL. User will be redirected to this page after upload. should display uploaded file 
define('SUCCESS_URL','successuploadlink.php');

// Allowed file extensions. Will only allow these extensions if not empty.
// Example: $exts = array('avi','mov','doc'); added 2 file formats
$exts = array('mp4', 'avi', '3gp');



// rename file after upload? false - leave original, true - rename to some unique filename; decided against renaming the uploaded file
define('RENAME_FILE', false);

// put a string to append to the uploaded file name (after extension);
// this will reduce the risk of being hacked by uploading potentially unsafe files;
// sample strings: aaa, my, etc.
define('APPEND_STRING', '');

// Need uploads log? Logs would be saved in the MySql database.
define('DO_LOG', true);

// MySql data (in case you want to save uploads log)
define('DB_HOST','localhost'); // host, usually localhost
define('DB_DATABASE','one_nation_database'); // database name done 
define('DB_USERNAME','root'); // username
define('DB_PASSWORD',''); // password


ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);



/*done settings*/

####################################################################
###  END OF SETTINGS.
####################################################################

// Allow script to work long enough to upload big files (in seconds, 2 days by default)
@set_time_limit(172800);

// following may need to be uncommented in case of problems
// ini_set("session.gc_maxlifetime","10800");

function showUploadForm($message='') {
  $max_file_size_tag = '';
  if (MAX_FILE_SIZE > 0) {
    // convert to bytes
    $max_file_size_tag = "<input name='MAX_FILE_SIZE' value='".(MAX_FILE_SIZE*1024)."' type='hidden' >\n";
  }

  // Load form template
  include ('fileForm-upload.php');
}// end of showUploadForm function

// errors list
$errors = array();

$message = '';

// we should not exceed php.ini max file size
$ini_maxsize = ini_get('upload_max_filesize');
if (!is_numeric($ini_maxsize)) {
  if (strpos($ini_maxsize, 'M') !== false)
    $ini_maxsize = intval($ini_maxsize)*1024*1024;
  elseif (strpos($ini_maxsize, 'K') !== false)
    $ini_maxsize = intval($ini_maxsize)*1024;
  elseif (strpos($ini_maxsize, 'G') !== false)
    $ini_maxsize = intval($ini_maxsize)*1024*1024*1024;
}
if ($ini_maxsize < MAX_FILE_SIZE*1024) {
  $errors[] = "Alert! Maximum upload file size in php.ini (upload_max_filesize) is less than script's MAX_FILE_SIZE";
}

// show upload form
if (!isset($_POST['submit'])) {
  showUploadForm(join('',$errors));
}

// process file upload
else {
  
    while(true) {
     
    // make sure destination folder exists
    if (!@file_exists(DESTINATION_FOLDER)) {
      $errors[] = "Destination folder does not exist or no permissions to see it.";
      break;
    }
     //the following may compromise performance
	 require_once 'uploadFormveri.php';
	 if ($errorulF !== ''){
       $errors[] = $errorulF;
	   break;
	 }
    // check for upload errors
	
    $error_code = $_FILES['filename']['error'];
	
    if ($error_code != UPLOAD_ERR_OK ) {
      switch($error_code) { // this needs work
        case UPLOAD_ERR_INI_SIZE: 
          // uploaded file exceeds the upload_max_filesize directive in php.ini
          $errors[] = "File is too big (1).";
          break;
        case UPLOAD_ERR_FORM_SIZE: 
          // uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form
          $errors[] = "File name has too many characters rename to less than 20 (2).";
          break;
        case UPLOAD_ERR_PARTIAL:
          // uploaded file was only partially uploaded.
          $errors[] = "File was partially uploaded (1).";
          break;
        case UPLOAD_ERR_NO_FILE:
          // No file was uploaded
          $errors[] = "Could not upload file (2).";
          break;
        case UPLOAD_ERR_NO_TMP_DIR:
          // Missing a temporary folder
          $errors[] = "Could not upload file temporary folder missing.(3).";
          break;
        case UPLOAD_ERR_CANT_WRITE:
          // Failed to write file to disk
          $errors[] = "Could not upload file (4).";
          break;
        case UPLOAD_ERR_EXTENSION:
          // File upload stopped by extension
          $errors[] = "Allowed to only enter files with avi, mp4 and 3gp extensions. (5).";
          break;
		  
		default:
		  $errors[] = "Unknown upload error pick a different file to upload.";
		} // switch
     
	 // leave the while loop
      break;
    }

    // get file name (not including path)
    $filename = @basename($_FILES['filename']['name']);
      
    // filename of temp uploaded file
    $tmp_filename = $_FILES['filename']['tmp_name'];

    $file_ext = @strtolower(@strrchr($filename,"."));
    if (@strpos($file_ext,'.') === false) { // no dot? strange
      $errors[] = "Suspicious file name or could not determine file extension.";
      break;
    }
    $file_ext = @substr($file_ext, 1); // remove dot

    // check file type if needed
    if (count($exts)) {   /// some day maybe check also $_FILES['user_file']['type']
      if (!@in_array($file_ext, $exts)) {
        $errors[] = "Files of this type are not allowed for upload.";
        break;
      }
    }

    // destination filename, rename if set to true
    $dest_filename = $filename;
    if (RENAME_FILE) {
      $dest_filename = md5(uniqid(rand(), true)) . '.' . $file_ext;
    }
    // append predefined string for safety
    $dest_filename = $dest_filename . APPEND_STRING;

    // get size
    $filesize = intval($_FILES["filename"]["size"]); // filesize($tmp_filename);

    // make sure file size is ok
    if (MAX_FILE_SIZE > 0 && MAX_FILE_SIZE*1024 < $filesize) {
      $errors[] = "File is too big (3).";
      break;
    }

    if (!@move_uploaded_file($tmp_filename , DESTINATION_FOLDER . $dest_filename)) {
      $errors[] = "Could not upload file (6).";
      break;
    }

    if (DO_LOG) {
      
      $link = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	  
	  if ($link->connect_error) die($link->connect_error);
	  
	  $m_ip = $link->real_escape_string($_SERVER['REMOTE_ADDR']);
      
      $m_size = $filesize;
      $m_fname = $link->real_escape_string($dest_filename);
      $sql = "insert uploads (log_filename,log_size,log_ip,active_channel,channel_name,user_name,video_title,video_description) values ('$m_fname','$m_size','$m_ip','$active_channel','$user','$user','$video_title','$video_description')";
	  
	  $result = $link->query($sql);
	  
      
      if (!$result) {
        $errors[] = "Could not run query.";
        break;
      }
    
    } // if (DO_LOG)

    // redirect to upload success url. ??????? might use die() system function to optimise resources. 
    header('Location:successuploadlink.php');
    break;

  } // while(true)

  // Errors. Show upload form.
  $message = join('',$errors);
  showUploadForm($message);

}

?>