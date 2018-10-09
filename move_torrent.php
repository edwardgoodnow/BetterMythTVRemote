 <?php
require('config.php');

 exec('transmission-remote --auth=transmission:transmission -t ' . $_GET['torrent'] . ' --move /mnt/storage/' . $_GET['folder'] . ' 2&>/dev/null') ;

 
switch($_REQUEST['folder']){
  case('videos'):
  //echo "/usr/local/bin/mythutil --scanvideos 2&>/dev/null";
    exec("/usr/local/bin/mythutil --scanvideos");
    return;
    sleep(5000);
    $query = mysqli_query($conn, "select * from videometadata where filename not like '%sample%' order by intid desc limit 1");
            $exts = array('avi', 'mp4', 'mkv', 'flv', 'wmv');
            $i=1;
            while($row = mysqli_fetch_array($query)){

                    $ext = pathinfo('/mnt/storage/videos/' . $row['filename'], PATHINFO_EXTENSION);
                    if(!preg_match('/sample/i', $row['title']) & in_array($ext, $exts)){
                
                    if(!file_exists('/mnt/storage/webm/'. basename($row['filename']) . '.webm' )  & $i<=5){
                        $cmd = '/usr/bin/ffmpeg -i "/mnt/storage/videos/'. str_replace("/mnt/storage/Videos/", "", $row['filename']) . '"  -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 "/home/apache/webm/'. basename($row['filename']) . '.webm" -hwaccel cuvid -threads 8  >  "/home/apache/logs/' . basename($row['filename']) . '-output.txt" 2>&1 & bg';echo $cmd;
                          //          exec($cmd);
                          ob_flush();
                             shell_exec($cmd);
                                    $i++;
                                }

                    }
            }
  break;
  case('music'):
    exec("/usr/local/bin/mythutil --scanmusic 2&>/dev/null", $out, $stats);

  break;
  }

  exec('transmission-remote --auth=transmission:transmission -t ' . $_GET['torrent'] . ' --remove');
