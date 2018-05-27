<?php
require('config.php');
if($old_ext != 'webm'){
 // echo "ffmpeg -i '" . $row['filename'] . "' -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 '" . str_replace( $old_ext, 'webm', $row['filename']) . "' 2&>/dev/null";
  //exec("mythutil --scanvideos");
  $webm = 0;
}else{
$webm = 1;
}
?>
            <li class="video" type="video/<?php echo $ext; ?>" alt="/mnt/storage/Videos/<?php echo $row['filename']; ?>" style="background-image:url('/getfile.php?path=<?php  
                if(!empty($row['coverfile'])){ 
                echo $conf['directory'] ;?>CoverArt/<?php echo  urlencode($row['coverfile']);
                
                }else{ 
                  echo '/home/apache/images/blank.png'; 
                  
                } ?>');">
              
                <input alt="Play" name="submit" onclick="javascript: post_remote('play file /mnt/storage/videos/<?php echo $row['filename']; ?>');" class="image" value="Play" src="images/right.png" type="image" /> 
                
                <?php if($webm == 1){ ?>
                        <img class="control_music" src="images/stream.png" onclick="javascript: $('#videoplayer source').attr('src', '/webm/<?php echo basename($row['filename']); ?>.webm'); document.getElementById('videoplayer').play(); $('#videoplayer').show();">
                <?php }else{ ?>
                        <img class="control_music" src="images/transcode.png" onclick="javascript:trancode_video('<?php echo $row['filename']; ?>');">
                <?php } ?>
                <span class="fa fa-pencil" onclick="edit_data('video', '<?php echo $row['intid']; ?>');"></span>
                <span class="title"><?php echo strlen($row['title'])>1?$row['title']:$row['filename']; ?></span>
                <span class="tagline"><?php echo $row['tagline']; ?></span>
                
            </li>
   
