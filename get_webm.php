<?php
require('config.php');
header("content-type: application/json");
$webm = 'webm/' . basename(urldecode($_REQUEST['video'])) . '.webm';
//echo $webm;
if(file_exists(
       '/home/apache/webm/'. basename(urldecode($_REQUEST['video'])) . '.webm'
    )){
        echo json_encode(array('video' => str_replace('/mnt/storage/', 'http://' . $_SERVER['SERVER_ADDR'] . '/' , $webm . '?_' . time())));
}else{


        $query = mysqli_query($conn, "select * from videometadata where filename like '%" . basename(urldecode($_REQUEST['video'])) . "%' order by intid desc limit 1");
        $exts = array('avi', 'mp4', 'mkv', 'flv', 'wmv');
        $i=1;
        $row = mysqli_fetch_array($query);
        
        $filename = basename($row['filename']);
        $id = $row['intid'];
              
               
         exec('rm "/home/apache/logs/' . basename(urldecode($_REQUEST['video'])) . '-output.txt" -f');
                exec('rm "/home/apache/webm/' . basename(urldecode($_REQUEST['video'])) . '.webm" -f');
                
                $cmd = '/home/apache/transcode.sh "/mnt/storage/videos/'. str_replace("/mnt/storage/Videos/", "", $row['filename']) . '" "/home/apache/webm/'. basename($row['filename']) . '.webm"  "/home/apache/logs/' . basename(urldecode($_REQUEST['video'])) . '-output.txt" &';  
                
                
                
                $cmd = '/usr/bin/ffmpeg -i "/mnt/storage/videos/'. str_replace("/mnt/storage/Videos/", "", $row['filename']) . '"  -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 -cpu-used -5 -deadline realtime "/home/apache/webm/'. basename($row['filename']) . '.webm" -hwaccel cuvid -threads 8  >  "/home/apache/logs/' . basename(urldecode($_REQUEST['video'])) . '-output.txt" 2>&1 & bg';
                 echo json_encode(array('msg' => 'Video needs to be converted', 'log' => basename(urldecode($_REQUEST['video'])) . "-output.txt", 'id' => $id, 'cmd' => $cmd)); 
                ob_flush();
                shell_exec($cmd);
        
        $i++;
                           

                
        
        
}
