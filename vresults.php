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
            <li class="video" type="video/<?php echo $ext; ?>" alt="/mnt/storage/Videos/<?php echo $row['filename']; ?>" id="video_<?php echo $row['intid']; ?>" style="background-image:url('/getfile.php?path=<?php  
                if(!empty($row['coverfile'])){ 
                echo $conf['directory'] ;?>CoverArt/<?php echo  urlencode($row['coverfile']);
                
                }else{ 
                  echo '/home/apache/images/blank.png'; 
                  
                } ?>');">
              
                <input name="submit"  class="image videobutton <?php if($webm == 1){ ?>converted<?php } ?>" value="Play" src="images/right.png" type="image" alt="/mnt/storage/videos/<?php echo str_replace("/mnt/storage/Videos", "", $row['filename']); ?>" /> 
                
                <?php if($webm == 1){ ?>
                      <!--  <img class="control_music" src="images/stream.png" onclick="javascript: $('#videoplayer source').attr('src', '/webm/<?php echo basename($row['filename']); ?>.webm'); document.getElementById('videoplayer').play(); $('#videoplayer').show();">-->
                <?php }else{ ?>
                      
                <?php } ?>
                <?php if(file_exists('/home/apache/logs/' . basename($row['filename']) . '-output.txt')){ ?>
                <span class="tr_progress" style="width:95%;display:block;height:15px;background-color:#fff;border-radius:4px;color:#666;margin-bottom:-45px;">0%</span>
                <script>
                $(document).ready(function(){
                  setTimeout(function(){ get_progress(<?php echo $row['intid']; ?>, '<?php echo basename($row['filename']) . '-output.txt'; ?>'); }, 5000);
                });
                </script>
                <?php } ?>
                <span class="fa fa-pencil" onclick="edit_data('video', '<?php echo $row['intid']; ?>');"></span>
                <span class="title"><?php echo strlen($row['title'])>1?$row['title']:$row['filename']; ?></span>
                <span class="tagline"><?php echo $row['tagline']; ?></span>
                
            </li>
            <script>
            function get_progress(vid, log){
           
                    $.ajax({
                        url: 'get_transcode_progress.php?log=' + log,
                        success:function(response){
                           if(response == 'remove'){
                            $('#video_' + vid + ' .tr_progress').remove();
                             return;
                           }
                            console.log(response);
                            $('#video_' + vid + ' .tr_progress').html(response);
                            setTimeout(function(){ get_progress(vid, log); }, 5000);
                        }
                     });   
            
            }
            function check_transcoded(video){
              $.ajax({
                    url: 'get_webm.php?video=' + encodeURIComponent(video),
                    cache:false,
                    success:function(response){
                        if(response.video){
                                var videocontainer = document.getElementById('videoplayer');
                                var videosource = document.getElementById('mp4video');
                                videosource.setAttribute('src', response.video);
                                videocontainer.load();
                                videocontainer.play();
                        }else{
                                alert(response.msg);
                                if($('#video_' + response.id + ' .tr_progress').length==0){
                                    $('#video_' + response.id).append('<span class="tr_progress" style="width:95%;display:block;height:15px;background-color:#fff;border-radius:4px;color:#666;margin-bottom:-45px;">0%</span>');
                                }else{
                                    $('#video_' + response.id + ' .tr_progress').html('0%');
                                }
                                setTimeout(function(){ get_progress(response.id, response.log); }, 5000);
                        }
                    }
                });    
            }
            $('.videobutton').each(function(){
              
              html ='<i onclick="javascript: post_remote(\'play file ' + $(this).attr('alt') + '\');" style="cursor:pointer;">Play On Server</i><br />';
              html += '<i onclick="javascript: check_transcoded(\'' + $(this).attr('alt') + '\');" style="cursor:pointer;">Play Locally</i>';
              //document.getElementById(\'videoplayer\').play(); $(\'#videoplayer\').show();
              $(this).qtip({content: { text: html }, hide:false});
            
            });
            </script>
   
