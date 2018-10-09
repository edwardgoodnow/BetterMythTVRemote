<?php
if(empty($chosen_playlist)){
//include("load_playlists.php");

}

//echo "select * from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1";
$query = mysqli_query($conn, "select * from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1");
$songs = array();
if(mysqli_num_rows($query)==0){
  echo "<li>Please add some songs</li>";

}
$row= mysqli_fetch_array($query);
 

        $songs = explode(',', $row['playlist_songs']);
        
        $count=count($songs);
        
         if($row['songcount']>0){
         $limit=25;
         $n=@$_REQUEST['start']?$_REQUEST['start']:0 * $limit;
         foreach($songs as $k => $song){
           if($k<$n){
             unset($songs[$k]);
           }else if($k>$n + $limit){
             unset($songs[$k]);
           }  
         }
         
          ?>
          <li class="nav">
                <?php
                if($n>0){
                ?>
                            <a class="prev left" href="javascript:;" onclick="nav_playlist(<?php echo $n - 1; ?>, <?php echo $row['playlist_id']; ?>, '<?php echo $row['playlist_name'];?>');">Prev</a>
                <?php } 
                ?>
                <a class="clear_list" href="javascript:;" onclick="clear_playlist('<?php echo $chosen_playlist; ?>');">Clear Playlist</a>
                <?php
                if($count>$n*$limit){
                ?> 
                            <a class="next right" href="javascript:;" onclick="nav_playlist(<?php echo $n + 1; ?>, <?php echo $row['playlist_id']; ?>, '<?php echo $row['playlist_name'];?>');">Next</a>
                <?php } ?>
        </li> 
    
          <?php     
          
              $artists = array();
                    foreach($songs as $k => $v){ 
                      if(!empty($v)){
                    
                            $qry = mysqli_query($conn, "select music_songs.song_id, music_songs.name, mg.genre, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id  where music_songs.song_id=$v");
                            
                        
                                while($rowm = mysqli_fetch_array($qry)){
                                if(!in_array($rowm['artist_name'], $artists)){
                                  echo "<li style=\"background-color:#666;\">" . $rowm['artist_name'] . "</li>";
                                  $artists[] = $rowm['artist_name'];
                                }
                                    echo "<li id=\"song_" . $rowm['song_id'] . "\" title=\"" . $rowm['song_id'] . "\" class=\"song_entry_" . $rowm['song_id'] . "\"><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" /><span class=\"song_name\">" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "</span><br /><span class=\"artist_name\">" . $rowm['artist_name'] . "</span><br /><span class=\"genre\">" . $rowm['genre'] . "</span> <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" /><img class=\"control_music\" src=\"images/minus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'remove', '$chosen_playlist');\" /><a href=\"song.php?song_id=" . $rowm['song_id'] . "\" style=\"display:none;\" class=\"song_link\"></a></li>";
                                
                                }
                            }
                       
                    }
       
        ?>
       
  
        <li class="nav">
                <?php
                if($n>0){
                ?>
                            <a class="prev left" href="javascript:;" onclick="nav_playlist(<?php echo $n - 1; ?>, <?php echo $row['playlist_id']; ?>, '<?php echo $row['playlist_name'];?>');">Prev</a>
                <?php } 
                ?>
                <a class="clear_list" href="javascript:;" onclick="clear_playlist('<?php echo $chosen_playlist; ?>');">Clear Playlist</a>
                <?php
                if($count>$n*$limit){
                ?> 
                            <a class="next right" href="javascript:;" onclick="nav_playlist(<?php echo $n + 1; ?>, <?php echo $row['playlist_id']; ?>, '<?php echo $row['playlist_name'];?>');">Next</a>
                <?php } ?>
        </li> 
       <?php }else{
        echo "<li>Please add some songs</li>";
        }
        
