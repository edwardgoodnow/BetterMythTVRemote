<?php
ini_set('display_errors', 1);
require('config.php');
function TimeToSec($time) {
    $sec = 0;
    foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
    return $sec;
}
function progress(){
$content = file_get_contents('/home/apache/logs/' . basename($_REQUEST['log']));
// # get duration of source
preg_match("/Duration: (.*?), start:/", $content, $matches);

$rawDuration = $matches[1];

// # rawDuration is in 00:00:00.00 format. This converts it to seconds.
$duration = TimeToSec(explode(".", $rawDuration)[0]);



// # get the current time
preg_match_all("/time=(.*?) bitrate/", $content, $matches); 

$last = array_pop($matches);

// # this is needed if there is more than one match
if (is_array($last)) {
$max = max(array_keys($last));

    $lastf = $last[$max];
   
}


//echo TimeToSec($lastf);
$curTime = TimeToSec(explode(".", $lastf)[0]);
//echo $curTime;

// # finally, progress is easy
$progress = $curTime/$duration;
$progress = (($curTime * 100)/($duration));
//echo $duration - $curTime;
return array($progress, $duration - $curTime);
}
if(file_exists('/home/apache/logs/' . basename($_REQUEST['log']) )){
        if(progress()[0]>=100){
        exec('rm /home/apache/logs/' . basename($_REQUEST['log']) . ' -f');

        echo 'remove';
        exit;
        }


}
$progress=progress();

$init = $progress[1];
$hours = floor($init / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;

echo '<span style="background-color:red;display:block;height:15px;width:' . number_format($progress[0], 2, '.', '') .'%"></span>'. number_format($progress[0], 2, '.', '') . '%<br />ETA:' . "$hours:$minutes:$seconds"  ;
