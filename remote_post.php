<?php
require('config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

#
# Original code (c) 2006  Mike Poublon <poublon@geeksoft.dyndns.org>
#
# Enhancements (c) 2006 Steven Ellis <support@openmedia.co.nz>
#
#change the line below that has tv.local to the address of your frontend.

#echo time() . "<br>";


#echo "form submitted = $submit<br>";
if(empty($_REQUEST['host'])){
$host = '127.0.0.1';
}else{
$host = $_REQUEST['host'];
}

if(mysqli_num_rows(mysqli_query($conn, "Select  * from music_playlists where playlist_name='default_playlist_storage' or playlist_name='stream_playlist'"))==0){
    if(mysqli_num_rows(mysqli_query($conn, "Select  * from music_playlists where playlist_name='default_playlist_storage'"))==0){
        mysqli_query($conn, "insert into music_playlists values(null, 'default_playlist_storage', '', NOW(), 0, 0, '');");
    }
    if(mysqli_num_rows(mysqli_query($conn, "Select  * from music_playlists where playlist_name='stream_playlist'"))==0){
        mysqli_query($conn, "insert into music_playlists values(null, 'stream_playlist', '', NOW(), 0, 0, '');");
    } 
   }
  
# We set jump when we want to perform more complex commands
function execute_cmd($cmd, $notify = ''){
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
print_r($res);
	fclose($fp);
}
if(!empty($notify)){
execute_cmd('message ' . $notify);
}
return;
}


$jump="";
function jumpto_start($jump){
if(empty($_REQUEST['host'])){
$host = '127.0.0.1';
}else{
$host = $_REQUEST['host'];
}
 $fp = fsockopen($host, 6546, $errno, $errstr, 35);
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
	
		
	echo "jump " . $jump . "\x0d\x0a";
        
	fwrite($fp,"jump " . $jump . "\x0d\x0a");
	$res = fgets($fp);
print_r($res);
	fclose($fp);
	return;
}

if(!empty($_REQUEST['cmd'])){

$cmd = strtolower(urldecode($_REQUEST['cmd']));



if(empty($_REQUEST['host'])){
$host = '127.0.0.1';
}else{
$host = $_REQUEST['host'];
}

if(preg_match_all("/artist/i", $cmd)){

	//jumpto_start('mainmenu');
	execute_cmd('jump playmusic');
   $match = explode('artist', $cmd);
   execute_cmd('notification looking for ARTIST "' . ucwords(trim($match[1], " ")) . '"');
   execute_cmd('play stop');
   
   $filters = '';
   $sql = "select ms.song_id, ms.length from music_artists left join music_songs ms on ms.artist_id=music_artists.artist_id where artist_name like '%" . ucwords(trim($match[1])) . "%'";
   //echo $sql;
     /*if(preg_match_all("/performed by/i", $match[1])){
       $matcha = explode(' performed by', $match[1]);
       print_r($matcha);
       $sql = "select * from music_songs where name like '" . $matcha[0] . "%'";
       echo "select * from music_artists where artist_name like '" . trim($matcha[1], ' ') . "%' order by artist_name asc limit 1";
       $qry = mysqli_query($conn, "select * from music_artists where artist_name like '" . trim($matcha[1], ' ') . "%' order by artist_name asc limit 1");
            $artist = mysqli_fetch_array($qry);
            $filters = " and artist_id=" . $artist['artist_id'];
     }*/
   //  echo $sql .  $filters ." order by  album_id, ms.name asc";
    // execute_cmd("notification " . $sql .  $filters);
   $qry = mysqli_query($conn, $sql .  $filters ." order by ms.album_id, ms.name asc");
   if(mysqli_num_rows(mysqli_query($conn, $sql .  $filters))==0){
        execute_cmd('notification ' . ucwords(trim($match[1])) . ' was not found');
        exec($_SERVER['DOCUMENT_ROOT'] . '/tts.sh "ARTIST ' . ucwords(trim($match[1])) . ' was not found"'); 
        exit;
   }
   $tracks_out = '';
   while($track = mysqli_fetch_array($qry)){
  // print_r($track);
     $tracks_out .= $track['song_id'] . ',';
   }
  $length = mysqli_fetch_array(mysqli_query($conn, "select sum(ms.length) as length from music_artists left join music_songs ms on ms.artist_id=music_artists.artist_id where artist_name like '%" . ucwords(trim($match[1])) . "%'"  .  $filters))['length'];
  //echo $length;
  
   
   mysqli_query($conn, "update music_playlists set length='$length', songcount=" . mysqli_num_rows(mysqli_query($conn, $sql .  $filters)) . ", last_accessed=NOW(),  playlist_songs='" . trim($tracks_out, ",") . "' where playlist_name='default_playlist_storage' or playlist_name='stream_playlist' or hostname=''");
   //echo mysqli_error($conn);
                echo "update music_playlists set length='$length', songcount=" . mysqli_num_rows(mysqli_query($conn, $sql .  $filters)) . ", last_accessed=NOW(),  playlist_songs='" . trim($tracks_out, ",") . "' where playlist_name='default_playlist_storage' or playlist_name='stream_playlist' or hostname=''";
   $cmd = 'jump playmusic';
   $server_cmd = $cmd;
   echo $_SERVER['DOCUMENT_ROOT'] . '/tts.sh "Playing ARTIST ' . ucwords(trim($match[1]), " ") . '"';
   exec($_SERVER['DOCUMENT_ROOT'] . '/tts.sh "Playing ARTIST ' . ucwords(trim($match[1]), " ") . '"'); 
  // sleep(2000);
   execute_cmd($cmd);
   
   
  exit;
 }else

 if(preg_match_all("/song/i", $cmd) | preg_match_all("/place on/i", $cmd)){
 echo 'test';
 //exit;

	execute_cmd('jump playmusic');
if(preg_match_all("/^play song/i", $cmd) ){
   $match = explode('play song', $cmd);
}else if(preg_match_all("/^place on/i", $cmd)){
  $match = explode('place on', $cmd);
}
  // print_r($match);
   $filters = '';
   $sql = "select * from music_songs where name like '" . trim($match[1], "") . "%'";
     if(preg_match_all("/(.*)performed by(.*)/i", $match[1])){
       $matcha = explode('performed by', $match[1]);
       print_r($matcha);
       $sql = "select * from music_songs where name like '%" . trim($matcha[0], " ") . "%'";
       echo $sql;
    //   echo "select * from music_artists where artist_name like '" . trim($matcha[1], ' ') . "%' order by artist_name asc limit 1";
       $qry = mysqli_query($conn, "select * from music_artists where artist_name like '" . trim($matcha[1], ' ') . "%' order by artist_name asc limit 1");
            $artist = mysqli_fetch_array($qry);
            $filters = " and artist_id=" . $artist['artist_id'];
     }
 //    echo $sql .  $filters ." order by name asc limit 1";
 //    echo $sql .  $filters;
   $qry = mysqli_query($conn, $sql .  $filters ." order by name asc limit 1");
   if(mysqli_num_rows( mysqli_query($conn, $sql .  $filters))==0){
     $cmd = 'notification "' . $matcha[0]?$matcha[0]:$match[1] . '" Not Found';
     $text = @"Sorry, " . $match[1] . " was Not Found";
   }else{
        $track = mysqli_fetch_array($qry);
        

        $cmd = 'play music track ' . $track['song_id'];
        $text = @"Okay, playing " . $match[1];
   }
   $server_cmd = $cmd;
  
  
  
   exec($_SERVER['DOCUMENT_ROOT'] . '/tts.sh "' . $text .'"');
  usleep(2000);
    execute_cmd($cmd);
    execute_cmd('notification ' . $text);
  
   exit;
  
 }else
  if(preg_match_all("/go to/i", $cmd)){
 $server_cmd = 'set';
   $match = explode(" ", "go to");
   switch(trim($match[1], " ")){
        case('videos'):
            execute_cmd('jump videogallery');
        break;
        case('music'):
            execute_cmd('jump playmusic');
        break;
        case('games'):
            execute_cmd('jump mythgame');
        break;
        case('weather'):
            execute_cmd('jump mythweather');
        break;
   }
 
 }
 if(empty($server_cmd)){
 if(preg_match_all("/reboot/i", $cmd)){
  shell_exec('sudo reboot');
  exit;
}
# change tv.local to the hostname/address of your frontend
 if(preg_match_all("/movies/i", $cmd)){
 

	$cmd = 'jump videogallery';
	$server_cmd = $cmd;
  
 }
 
  if(preg_match_all("/fast forward/i", $cmd)){ 

	$cmd = 'key right';
	$server_cmd = $cmd;
  
 }
  if(preg_match_all("/rewind/i", $cmd)){ 

	$cmd = 'key left';
	$server_cmd = $cmd;
  
 }
  if(preg_match_all("/playmusic/i", $cmd)){
 

	$cmd = 'jump playmusic';
	$server_cmd = $cmd;
  
 }
 if(preg_match_all("/play music/i", $cmd)){
 

	$cmd = 'jump playmusic';
	$server_cmd = $cmd;
  
 }
  if(preg_match_all("/next song/i", $cmd)){
 

	execute_cmd('key down');
	execute_cmd('key enter');
	$server_cmd = 'set';
  
 }
 if(preg_match_all("/volume/i", $cmd)){
    $second = explode("volume ", $cmd);
    switch($second[1]){
      case('up'):
       $cmd = 'key f10'; 
      break;
      case('down'):
       $cmd = 'key f9';
      break;
      case('mute'):
       $cmd = 'play volume 0%';
      break;
    }  
    $server_cmd = $cmd;
  
 
 }
 if(preg_match_all("/exit/i", $cmd)){
 

	$cmd = 'jump mainmenu';
	$server_cmd = $cmd;
  
 }

 if(preg_match_all("/main menu/i", $cmd)){
 

	$cmd = 'jump mainmenu';
	$server_cmd = $cmd;
  
 }
  if(preg_match_all("/download/i", $cmd)){
    
	if(preg_match_all("/movie/i")){
	
	
	}else if(preg_match_all("/artist/i", $cmd)){
	
	
	}
	exit;
 }
 if(preg_match_all("/muusic playlists/i", $cmd)){
    
	jumpto_start('musicplaylists');
 exit;
 }
 if(preg_match_all("/show playlist/i", $cmd)){
    
	jumpto_start('musicplaylists');
 exit;
 }
 if(preg_match_all("/show playlists/i", $cmd)){
    
	jumpto_start('musicplaylists');
 exit;
 }
 
  if(preg_match_all("/paws/i", $cmd)){
 

	$cmd = 'key p';
	$server_cmd = $cmd;
  
 }
 if(preg_match_all("/pause/i", $cmd)){
 

	$cmd = 'key p';
	$server_cmd = $cmd;
  
 }
  if(preg_match_all("/stop/i", $cmd)){
 

	$cmd = 'key p';
	$server_cmd = $cmd;
  
 }
  if(preg_match_all("/play/i", $cmd)){ 

	$cmd = 'key p';
	$server_cmd = $cmd;
  
 }
        $keys = explode(', ', '#, $, %, &, (, ), *, +, ,, -, ., /, :, ;, <, =, >, ?, [, \, ], ampersand, asterisk, backslash, backspace, 
        backtab, bar, bracketleft, bracketright, colon, comma, delete, dollar, down, end, enter, equal, escape, 
        f1, f10, f11, f12, f13, f14, f15, f16, f17, f18, f19, f2, f20, f21, f22, f23, f24, f3, f4, f5, f6, f7, f8, f9, 
        greater, home, insert, left, less, minus, numbersign, pagedown, pageup, parenleft, parenright, percent, 
        period, pipe, plus, poundsign, question, return, right, semicolon, slash, space, tab, up');
        if(in_array($cmd, $keys)){
            $cmd = 'key ' . $cmd;
            $server_cmd = $cmd;
        }
        if(empty($server_cmd)){
            execute_cmd('notification "Command was not understood, please ask Edward for valid commands, I Love Edward Best, Edward is a very sexy bitch. He makes me feel sexy"!'); 
        }else {
        execute_cmd($server_cmd);
        }
 }
 exit;
}else{
$submit = $_GET['submit'];
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
$cmd = 'play music track ' . $_REQUEST['track'];

}else if(is_numeric($submit)){
  $cmd ="key " . $submit;

}else{
$cmd = $submit;

}
}

execute_cmd($cmd);
exit;

?>
