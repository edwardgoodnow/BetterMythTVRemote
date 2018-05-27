<?php
ini_set('display_errors', 1);
require('config.php');
$query = mysqli_query($conn, "select * from videometadata order by intid desc ");
$exts = array('avi', 'mp4', 'mkv', 'flv', 'wmv');
$i=1;
while($row = mysqli_fetch_array($query)){

        $ext = pathinfo('/mnt/storage/videos/' . $row['filename'], PATHINFO_EXTENSION);
        if(!preg_match('/sample/i', $row['title']) & in_array($ext, $exts)){
       
         if(!file_exists('/mnt/storage/webm/'. basename($row['filename']) . '.webm' )  & $i<=5){
           
                        exec('ffmpeg -i "/mnt/storage/videos/'. $row['filename'] . '" -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 "/mnt/storage/webm/'. basename($row['filename']) . '.webm" &> /dev/null &');
                        $i++;
                    }

        }
}
