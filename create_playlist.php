<?php
@session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
if(!empty($_REQUEST['name'])){
    mysqli_query($conn, "insert into music_playlists values(null, '" . $_REQUEST['name'] . "', '', NOW(), 0, 0, '');");
    echo "insert into music_playlists values(null, '" . $_REQUEST['name'] . "', '', NOW(), 0, 0, '');";
}
if(empty($_REQUEST['playlist'])){
$chosen_playlist = 'default_playlist_storage';
}else{
$chosen_playlist = $_REQUEST['playlist'];
}
//echo "select * from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1";
$query = mysqli_query($conn, "select * from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1");
$songs = array();
if(mysqli_num_rows($query)==0){
  echo "<li>Please add some songs</li><script></script>";

}
$row= mysqli_fetch_array($query);
 

        $songs = explode(',', $row['playlist_songs']);
        $count=count($songs);
         
         $limit=5;
         $n=@$_REQUEST['start']?$_REQUEST['start']:0 * $limit;
         foreach($songs as $k => $song){
           if($k<$n){
             unset($songs[$k]);
           }else if($k>$n + $limit){
             unset($songs[$k]);
           }  
         }
         
          
                
                    foreach($songs as $k => $v){ 
                      if(!empty($v)){
                    
                            $qry = mysqli_query($conn, "select music_songs.song_id, music_songs.name, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id  where music_songs.song_id=$v");
                            while($rowm = mysqli_fetch_array($qry)){
                                echo "<li ><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" />" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "<br />" . $rowm['artist_name'] . " <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" /><img class=\"control_music\" src=\"images/minus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'remove');\" /></li>";
                            
                            }
                            }
                       
                    }
  ?>
  
        <li>
  <?php
  if($n>0){
  ?>
            <a class="prev left" href="javascript:;" onclick="nav_playlist(<?php echo $n - 1; ?>);">Prev</a>
  <?php } 
  ?>
  <a class="clear_list" href="javascript:;" onclick="clear_playlist();">Clear Playlist</a>
  <?php
  if($count>$n*$limit){
  ?> 
            <a class="next right" href="javascript:;" onclick="nav_playlist(<?php echo $n + 1; ?>);">Next</a>
  <?php } ?>
        </li>
