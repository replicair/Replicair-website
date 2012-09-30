<?php
     
$filename = $_GET['filename'];
$type = $_GET['type'];
$filepath = $filename;
     
// Modify this line to indicate the location of the files you want people to be able to download
// This path must not contain a trailing slash. ie. /temp/files/download
//$download_path = "/";
     
// Make sure we can't download files above the current directory location.
if(stristr("\.\.", $filename)) die("I'm sorry, you may not download that file.");
$file = str_replace("..", "", $filename);
     
// Make sure we can't download .ht control files.
if(stristr("\.ht.+", $filename)) die("I'm sorry, you may not download that file.");

if ($type == "pressreview") {
	$filepath = "../../content/pressreview/".$filename;
}
else {
	die("Unknow type file");
}

// Test to ensure that the file exists.
if(!file_exists($filepath)) die("I'm sorry, the file doesn't seem to exist : ".$filepath);
     
// Extract the type of file which will be sent to the browser as a header
$type = filetype($filepath);
     
// Get a date and timestamp
//$today = date("F j, Y, g:i a");
//$time = time();
     
// Send file headers
header("Content-type: $type");
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary");
header('Pragma: no-cache');
header('Expires: 0');
// Send the file contents.
set_time_limit(0);
readfile($filepath);
     
?>