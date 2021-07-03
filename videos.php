<?php  
include_once('Videostream.php'); 

echo playvideo();




  //echo "$filename - Size: " . filesize($filename) . "\n";
function playvideo(){
$speed = test_speed(1024);
$video_array = glob('test_upload/{*.mp4,*.mkv,*.flv,*.mov}', GLOB_BRACE);
foreach ($video_array as $filename) {
if($speed > 50 && filesize($filename) <= 10000000 ) { // a fast connection, send more byte for more accuracy
return $filename;	 
	break;
}elseif($speed > 500 && filesize($filename) <= 50000000 ) {
	return $filename;
	break;
	}
}
 
}
# or: 
function microtime_diff($a, $b) {
list($a_dec, $a_sec) = explode(" ", $a);
list($b_dec, $b_sec) = explode(" ", $b);
return $b_sec - $a_sec + $b_dec - $a_dec;
}

function test_speed($test_size) {
flush();
$start_time = microtime();
$comment = "<!--O-->";
$len = strlen($comment);
for($i = 0; $i < $test_size; $i += $len) {
echo $comment;
}
flush();
$duration = microtime_diff($start_time, microtime());
if($duration != 0) {
return $test_size / $duration / 1024;
}
else {
return log(0);
}
}

$speed = test_speed(10240);
if($speed > 500) { // a really fast connection, send even more byte for
 
$speed = test_speed(102400);
}
 
//

echo sprintf("Download speed is %0.3f kb/s", $speed);
//$stream = new VideoStream('test_upload/sample_4.mkv');
//$stream->start();

?>