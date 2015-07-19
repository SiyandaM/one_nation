

<form method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class = "error"><?php echo $message; ?></div><?php echo $max_file_size_tag; ?>
  <div class="form-group form-group-lg">
     <label for="active_channel" class="col-md-3 control-label">Activate My Channel</label>
	  <div class="col-md-9">
       <select class="form-control input-lg" id="active_channel" name="active_channel" placeholder="Select" required>
	      <option>Yes</option>
          <option>No</option>
	   </select>
	  </div>
 </div>
 <!-- <div class= "form-group form-group-lg">
   <label class="control-label col-md-3" for="channel_name">Enter channel name:</label> 
    <div class="col-md-9">
      <input class="form-control" type="text" id= "channel_name" size="50" name="channel_name" required>
    </div>
 </div>-->
 
 <!--<div class="form-group form-group-lg">
       <label class="control-label col-md-3" for="channel_image">Select channel image:</label> 
       <div class="col-md-9">
        <input class="form-control" type="file" id= "channel_image" size="50" name="channel_image">
       </div>
 </div>-->
 
   <div class="form-group form-group-lg">
     <label class="control-label col-md-3" for="filename">Select video to upload:</label> 
      <div class="col-md-9">
       <input class="form-control" type="file" id= "filename" size="50" name="filename" required >
      </div>
   </div>
 
 <div class= "form-group form-group-lg">
   <label class="control-label col-md-3" for="video_title">Enter video title:</label> 
    <div class="col-md-9">
    <input class="form-control" type="text" id= "video_title" size="50" name="video_title" required>
    </div>
 </div>
 
 <div class= "form-group form-group-lg">
   <label class="control-label col-md-3" for="video_description">Enter video description:</label> 
    <div class="col-md-9">
      <textarea class="form-control" type="text" id= "video_description" row="3" name= "video_description" required ></textarea>
    </div>
 </div>
 
 <div class= "row">
 <div class= "col-md-12">
   <input type="submit" class = "btn text-uppercase center-block links btn-lg active btn-block" value="Upload" name="submit">
 </div>
 </div>
</form><br><br>

