<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
#
# Original code (c) 2006  Mike Poublon <poublon@geeksoft.dyndns.org>
#
# Enhancements (c) 2006 Steven Ellis <support@openmedia.co.nz>
#
#change the line below that has tv.local to the address of your frontend.

#echo time() . "<br>";
$submit = $_REQUEST['submit'];
#echo "form submitted = $submit<br>";

# We set jump when we want to perform more complex commands
$jump="";

if ($submit == "Power"){
	#Power - not really used yet
    $key = "";
} else if ($submit == "TV"){
    $jump = "livetv";
} else if ($submit == "Music"){
    $jump = "playmusic";
} else if ($submit == "Video"){
    $jump = "mythvideo";
} else if ($submit == "Recordings"){
    $jump = "playbackrecordings";
} else if ($submit == "Guide"){
    $jump = "programguide";
} else if ($submit == "Pictures"){
    $jump = "mythgallery";
} else if ($submit == "Back") {
    $key = "escape";
} else if ($submit == "Info") {
    $key = "i";
} else if ($submit == "Menu") {
	#Menu
    $key = "m";
} else if ($submit == "U") {
    $key = "up";
} else if ($submit == "L") {
    $key = "left";
} else if ($submit == "D") {
    $key = "down";
} else if ($submit == "R") {
    $key = "right";
} else if ($submit == "OK") {
    $key = "enter";
} else if ($submit == "Page Up") {
    $key = "pageup";
} else if ($submit == "Page Dn") {
    $key = "pagedown";
} else if ($submit == "Vol Up") {
    $key = "bracketright";
} else if ($submit == "Vol Dn") {
    $key = "bracketleft";
} else if ($submit == "Mute") {
    $key = "f9";
} else if ($submit == "Pause") {
    $key = "p";
} else if ($submit == "Stop") {
    $key = "s";
} else if ($submit == "Play") {
    $key = "p";
} else if ($submit == "<<") {
    $key = "left";
} else if ($submit == ">>") {
    $key = "right";
} else if ($submit == "|<") {
	#skip commercial back
    $key = "q";
} else if ($submit == ">|") {
	#skip commercial
    $key = "z";
# Special keys used by myPVR
} else if ($submit == "#") {
    # Change tuner
    $key = "y";
} else if ($submit == "*") {
    #skip commercial
    $key = "z";
} else if($submit== 'select track'){
$jump = "playmusic";
$cmd = 'play music track ' . $_REQUEST['track'] ."\x0d\x0a";

}

else if ($submit == "0" || 
           $submit == "1" ||
           $submit == "2" ||
           $submit == "3" ||
           $submit == "4" ||
           $submit == "5" ||
           $submit == "6" ||
           $submit == "7" ||
           $submit == "8" ||
           $submit == "9" ) {
    $key = $submit;
}

set_time_limit (5);
# change tv.local to the hostname/address of your frontend
$fp = fsockopen("localhost", 6546, $errno, $errstr, 30);
if (!$fp) {
	echo "ERROR: $errstr ($errno)<br />\n";
} else {
	#stream_set_timeout ( $fp, 0, 100000);
	#$banner = stream_get_contents($fp);
	
	$banner = "";
	
	$c = fgetc($fp);
	while ($c !== false && $c != "#")
	{
		#echo "c = $c<br>\n";
		$banner .= $c;
		$c = fgetc($fp);
	}
	if ($c !== false)
	{
		$c = fgetc($fp); #Read in the extra space after the #
	}
	if(isset($cmd)){
	
	}else
		
	if ($jump != "") {
            $cmd = "jump $jump\x0d\x0a";
            $jump="";
	} 
	if($cmd != '';
            $cmd = "key $key\x0d\x0a";
        }
	fwrite($fp,$cmd);
	$res = fgets($fp);
	#echo "result = $res<br>\n";

	fclose($fp);
}


?>
