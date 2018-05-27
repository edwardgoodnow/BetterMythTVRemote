<?php
require('config.php');

?>
            <li class="game" type="video/<?php echo $ext; ?>" alt="<?php echo $row['rompath']; ?>" style="background-image:url('/getfile.php?path=<?php  
                if(!empty($row['boxart'])){ 
                echo $conf['directory'] ;?>CoverArt/<?php echo  urlencode($row['boxart']);
                
                }else{ 
                  echo '/home/apache/images/blank.png'; 
                  
                } ?>');">
                 
                
                
                <span class="title"><?php echo strlen($row['romname'])>1?$row['romname']:$row['rompath']; ?></span>
                <span class="tagline"><?php echo $row['gametype']; ?></span>
                <span class="fa fa-pencil" onclick="javascript:edit_data('game', '<?php echo $row['intid']; ?>');"></span>
                
            </li>
   
