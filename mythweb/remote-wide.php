<?
#
# Original code (c) 2006  Mike Poublon <poublon@geeksoft.dyndns.org>
#
# Enhancements (c) 2006 Steven Ellis <support@openmedia.co.nz>
#
#change the line below that has tv.local to the address of your frontend.

#echo time() . "<br>";
$submit = $_POST['submit'];
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
} else if ($submit == "0" || 
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
		
	if ($jump != "") {
            $cmd = "jump $jump\x0d\x0a";
            $jump="";
	} else {
            $cmd = "key $key\x0d\x0a";
        }
	fwrite($fp,$cmd);
	$res = fgets($fp);
	#echo "result = $res<br>\n";

	fclose($fp);
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MythTV Web Remote</title>
<link rel="stylesheet" type="text/css" media="screen" href="remote.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form method="post">
<table style="" align="left" border="0" cellspacing="0" width="300">

  <tbody>

    <tr>

      <td valign="top">
      <table border="0" cellspacing="0">

        <tbody>

          <tr style="height: 8px;" align="center">
            <td colspan="6"></td>

          </tr>

          <tr align="center">

            <td><input name="submit" class="txt" value="TV" type="submit" /></td>

            <td><input name="submit" class="txt" value="Music" type="submit" /></td>

            <td><input name="submit" class="txt" value="Video" type="submit" /></td>

            <td><input name="submit" class="txt" value="Recordings" type="submit" /></td>

            <td><input name="submit" class="txt" value="Guide" type="submit" /></td>

            <td><input name="submit" class="txt" value="Pictures" type="submit" /></td>

          </tr>

          <tr style="height: 8px;" align="center">

            <td>
            </td>
          </tr>

          <tr>

            <td colspan="3" align="center">
            <table style="width: 70%;" border="0" cellspacing="0">

              <tbody>

                <tr align="center">

                  <td>&nbsp;</td>

                  <td><input alt="Record" name="submit" class="image" value="Rec" src="images/rec.png" type="image" /> </td>

                  <td><input alt="Stop" name="submit" class="image" value="Stop" src="images/stop.png" type="image" /> </td>

                  <td><input alt="Pause" name="submit" class="image" value="Pause" src="images/pause.png" type="image" /> </td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><input alt="Rewind" name="submit" class="image" value="&lt;&lt;" src="images/fast_rewind.png" type="image" /> </td>

                  <td>&nbsp;</td>

                  <td><input alt="Play" name="submit" class="image" value="Play" src="images/right.png" type="image" /> </td>

                  <td>&nbsp;</td>

                  <td><input alt="Fast Forward" name="submit" class="image" value="&gt;&gt;" src="images/fast_forward.png" type="image" /> </td>

                </tr>

                <tr>

                  <td>&nbsp;</td>

                  <td><input alt="Skip Back" name="submit" class="image" value="|&lt;" src="images/skip_back.png" type="image" /> </td>

                  <td>&nbsp;</td>

                  <td><input alt="Skip Forward" name="submit" class="image" value="&gt;|" src="images/skip_forward.png" type="image" /> </td>

                  <td>&nbsp;</td>

                </tr>

              </tbody>
            </table>

            </td>

            <td colspan="3" align="center">
            <table border="0" cellspacing="0" width="60%">

              <tbody>

                <tr align="center">

                  <td align="right"><input name="submit" class="number" value="1" type="submit" /></td>

                  <td><input name="submit" class="number" value="2" type="submit" /></td>

                  <td align="left"><input name="submit" class="number" value="3" type="submit" /></td>

                </tr>

                <tr align="center">

                  <td align="right"><input name="submit" class="number" value="4" type="submit" /></td>

                  <td><input name="submit" class="number" value="5" type="submit" /></td>

                  <td align="left"><input name="submit" class="number" value="6" type="submit" /></td>

                </tr>

                <tr align="center">

                  <td align="right"><input name="submit" class="number" value="7" type="submit" /></td>

                  <td><input name="submit" class="number" value="8" type="submit" /></td>

                  <td align="left"><input name="submit" class="number" value="9" type="submit" /></td>

                </tr>

                <tr align="center">

                  <td align="right"><input name="submit" class="number" value="*" type="submit" /></td>

                  <td><input name="submit" class="number" value="0" type="submit" /></td>

                  <td align="left"><input name="submit" class="number" value="#" type="submit" /></td>

                </tr>

              </tbody>
            </table>

            </td>

          </tr>

          <tr style="height: 8px;" align="center">
            <td colspan="6"></td>

          </tr>

          <tr align="center">

            <td><input name="submit" class="txt" value="Back" type="submit" /></td>

            <td><input name="submit" class="txt" value="Info" type="submit" /></td>

            <td><input name="submit" class="txt" value="Menu" type="submit" /></td>

            <td><input name="submit" class="txt" value="Mute" type="submit" /></td>

            <td><input name="submit" class="txt" value="Clear" type="submit" /></td>

            <td><input name="submit" class="txt" value="Enter" type="submit" /></td>

          </tr>

          <tr style="height: 8px;" align="center">
            <td colspan="6"></td>
          </tr>

          <tr>

            <td colspan="6" align="center">
            <table border="0" cellspacing="0" width="50%">

              <tbody>

                <tr>

                  <td><input name="submit" class="txt" value="Vol Up" type="submit" /></td>

                  <td>&nbsp;</td>

                  <td><input alt="Up" name="submit" class="image" value="U" src="images/up.png" type="image" /> </td>

                  <td>&nbsp;</td>

                  <td><input name="submit" class="txt" value="Page Up" type="submit" /></td>

                </tr>

                <tr>

                  <td>&nbsp;</td>

                  <td><input alt="Left" name="submit" class="image" value="L" src="images/left.png" type="image" /> </td>

                  <td><input alt="OK" name="submit" class="image" value="OK" src="images/ok.png" type="image" /> </td>

                  <td><input alt="Right" name="submit" class="image" value="R" src="images/right.png" type="image" /> </td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><input name="submit" class="txt" value="Vol Dn" type="submit" /></td>

                  <td>&nbsp;</td>

                  <td><input alt="Down" name="submit" class="image" value="D" src="images/down.png" type="image" /> </td>

                  <td>&nbsp;</td>

                  <td><input name="submit" class="txt" value="Page Dn" type="submit" /></td>

                </tr>

              </tbody>
            </table>

            </td>

          </tr>

        </tbody>
      </table>

      </td>

    </tr>

  </tbody>
</table>

<form>
</body>
</html>
