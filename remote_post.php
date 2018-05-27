<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

#
# Original code (c) 2006  Mike Poublon <poublon@geeksoft.dyndns.org>
#
# Enhancements (c) 2006 Steven Ellis <support@openmedia.co.nz>
#
#change the line below that has tv.local to the address of your frontend.

#echo time() . "<br>";
$submit = $_GET['submit'];

#echo "form submitted = $submit<br>";

# We set jump when we want to perform more complex commands
$jump="";

if ($submit == "Power"){
	#Power - not really used yet
    $cmd ="";
} else if ($submit == "TV"){
    $cmd ="jump livetv";
} else if ($submit == "Music"){
    $cmd ="jump playmusic";
} else if ($submit == "Video"){
    $cmd ="jump mythvideo";
} else if ($submit == "Recordings"){
    $cmd ="jump playbackrecordings";
} else if ($submit == "Guide"){
    $cmd ="jump programguide";
} else if ($submit == "Pictures"){
    $cmd ="jump mythgallery";
} else if ($submit == "Back") {
    $cmd ="key escape";
} else if ($submit == "Info") {
    $cmd ="key i";
} else if ($submit == "Menu") {
	#Menu
    $cmd ="key m";
} else if ($submit == "U") {
    $cmd ="key up";
} else if ($submit == "L") {
    $cmd ="key left";
} else if ($submit == "D") {
    $cmd ="key down";
} else if ($submit == "R") {
    $cmd ="key right";
} else if ($submit == "OK") {
    $cmd ="key enter";
} else if ($submit == "Page Up") {
    $cmd ="key pageup";
} else if ($submit == "Page Dn") {
    $cmd ="key pagedown";
} else if ($submit == "Vol Up") {
    $cmd ="key bracketright";
} else if ($submit == "Vol Dn") {
    $cmd ="key bracketleft";
} else if ($submit == "Mute") {
    $cmd ="key f9";
} else if ($submit == "Pause") {
    $cmd ="play music pause";
} else if ($submit == "Stop") {
    $cmd ="play music stop";
} else if ($submit == "Play") {
    $cmd ="play music play";
} else if ($submit == "<<") {
    $cmd ="key left";
} else if ($submit == ">>") {
    $cmd ="key right";
} else if ($submit == "|<") {
	#skip commercial back
    $cmd ="key q";
} else if ($submit == ">|") {
	#skip commercial
    $cmd ="key z";
# Special keys used by myPVR
} else if ($submit == "#") {
    # Change tuner
    $cmd ="key y";
} else if ($submit == "*") {
    #skip commercial
    $cmd ="key z";
} else if($submit== 'select track'){
$jump = 1;
$cmd = 'jump play music track ' . $_REQUEST['track'] ."\x0d\x0a";

}else if(is_numeric($submit)){
  $cmd ="key " . $submit;

}else{
$cmd = $submit;

}
echo $cmd;

if(empty($_REQUEST['host'])){
$host = '127.0.0.1';
}else{
$host = $_REQUEST['host'];
}
# change tv.local to the hostname/address of your frontend
$fp = fsockopen($host, 6546, $errno, $errstr, 35);

if (!$fp) {
	echo "ERROR: $errstr ($errno)<br />\n";
} else {
	stream_set_timeout ( $fp, 0, 100000);
	$banner = stream_get_contents($fp);
	
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
	
		
	$cmd = "$cmd\x0d\x0a";
        
	fwrite($fp,$cmd);
	$res = fgets($fp);
echo "result = $res<br>\n";

	fclose($fp);
}
exit;

?>
