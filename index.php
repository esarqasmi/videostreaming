<?php
$servername = "localhost";
$username = "danubeproperties_livevms";
$password = 'DieZY,=}lD3A';
$dbname = "danubeproperties_ibms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


extract($_POST);

$target_dir = "test_upload/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if($upd)
{
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov"  && $imageFileType != "mkv" && $imageFileType != "3gp" && $imageFileType != "mpeg")
{
    echo "File Format Not Suppoted";
} 

else
{

$video_path=$_FILES['fileToUpload']['name'];

$conn->query("insert into video(video_name) values('$video_path')");

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);

echo "uploaded ";

}

}

//display all uploaded video

 ?><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

 <link rel="stylesheet"  media="screen" href="css/style.css" type="text/css"/>

 <div class="container">
 <div class="header">
 <h3>Video Streaming Task</h3>
 <div id="netspeed"></div>
 <a href="upload.html">Upload Video</a>
 </div>
 <?php 
$result=$conn->query("select * from video");

while($all_video = $result->fetch_assoc()) {
    
//if(file_exists('test_upload/'.$all_video['video_name']) ){ 
?>
<div class='vidcontainer'>
   
   <div class="video_options">
       
<b>Title: <?php echo $all_video['video_name']; ?></b>
   <select class='qualitypick' autocomplete='off'>
      <option value="fullHD" selected>fullHD</option>
      <option value="720p">720p</option>
      <option value="360p">360p</option>
   </select> 
   <br/>
<!--   <video class="video" width="500" height="300" controls preload>
     <?php if(filesize('test_upload/'.$all_video['video_name']) > 5000000){ //more than 5Mb video ?>
      <source label="fullHD" src="test_upload/<?php echo $all_video['video_name']; ?>" type="video/mp4">
   <?php }else if(filesize('test_upload/'.$all_video['video_name']) < 5000000 && filesize('test_upload/'.$all_video['video_name']) >= 3000000){//if greate than 3MB but less than 5MB?>
      <source label="720p"  src="test_upload/<?php echo $all_video['video_name']; ?>" type="video/mp4" >
   <?php }else if(filesize('test_upload/'.$all_video['video_name']) < 3000000){//less than 3MB video ?>
      <source label="360p"   src="test_upload/<?php echo $all_video['video_name']; ?>" type="video/mp4">
      <?php } ?>
   </video>--> 
    <video class="video" width="500" height="300" controls preload>
      <source label="fullHD" src="test_upload/1.mp4" type="video/mp4">
      <source label="720p"  src="test_upload/2.mp4" type="video/mp4" >
      <source label="360p"   src="test_upload/3.mp4" type="video/mp4">
      </video>
   </div>
</div>
	
	
	<?php //}   ?>
	
	<?php }   ?>
    </div>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
	setTimeout(function(){
		var downlink = navigator.connection.downlink;
		$("#netspeed").text("Internet speed is : "+downlink+" Mbps");
		$( ".video" ).each(function() {
		var video = $(this);
		// videoDOM = video.get(0);
		if(downlink > 5 ){ //5 means 5 MB internet speed
			source = video.find("source[label=fullHD]"); 
			$('.qualitypick').val('fullHD');
		}else if( downlink > 1 && downlink < 2){
			source = video.find("source[label=720p]"); 
			$('.qualitypick').val('720p');
		}else{
			source = video.find("source[label=360p]"); 
			$('.qualitypick').val('360p');
		}

			source.remove();                 //Remove the source from select
			video.prepend(source);           //Prepend source on top of options
			video.load();  
		});                  //Reload Video
	// videoDOM.play();                 //Resume video
}, 500);



   $('.qualitypick').change(function(){ 

      //Have several videos in file, so have to navigate directly
      video = $(this).parent().find("video");
		var context =  $(this).val();
		console.log(context);
      //Need access to DOM element for some functionality
      videoDOM = video.get(0);

      curtime = videoDOM.currentTime;  //Get Current Time of Video
      source = video.find("source[label=" + context + "]"); //Copy Source
	
      source.remove();                 //Remove the source from select
      video.prepend(source);           //Prepend source on top of options
      video.load();                    //Reload Video
      videoDOM.currentTime = curtime;  //Continue from video's stop
      videoDOM.play();                 //Resume video
   })
})
</script>