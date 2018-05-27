<?php
@session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
if(empty($_REQUEST['playlist'])){
$chosen_playlist = 'default_playlist_storage';
}else{
$chosen_playlist = $_REQUEST['playlist'];
}
if(!empty($_REQUEST['clr'] )){
  mysqli_query($conn, "delete from music_playlists where playlist_name='$chosen_playlist'");
}
if(!empty($_POST['act'])){

$row = mysqli_fetch_array(mysqli_query($conn, "select * from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1"));

if(count($row)==0){
   mysqli_query($conn, "insert into music_playlists values(null, '$chosen_playlist', '', NOW(),'0', '0', 'localhost.localdomain');");

}
$songs = explode(",", $row['playlist_songs']);

 
 switch($_POST['act']){
    case('remove'):
     foreach (array_keys($songs) as $key => $value) {
          if($value==$_REQUEST['song_id']){
            unset($songs[$key]);
          
          }
        }
    break;
    case('add'):
     array_push($songs,$_REQUEST['song_id']);
    break;
    case('edit'):
    
    break;
    case('info'):
    
    break;

}

   mysqli_query($conn, "update music_playlists set playlist_songs='" . implode(",", $songs) . "', songcount='" . count($songs) . "', last_accessed=NOW() where  playlist_name='$chosen_playlist' order by playlist_id asc limit 1");
}
?>

<h2><label>Music Stream</label></h2>
<div id="streaming_music"><audio id="play_stream" src="" controls></audio></div>
<h2><label>Playlist</label></h2>
<div id="playlist_box">
<ul>
<?php
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
                        
                            $qry = mysqli_query($conn, "select music_songs.song_id, music_songs.name, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id  where music_songs.song_id=$v");
                            while($rowm = mysqli_fetch_array($qry)){
                                echo "<li ><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" />" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "<br />" . $rowm['artist_name'] . " <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" /><img class=\"control_music\" src=\"images/minus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'remove');\" /></li>";
                            
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
        </ul>
        </div>
        
        <h2 od="torrent_search_header" >
                <label id="search_for_torrent">Torrent Search</label>
        </h2>
        <div id="torrent_search_box"></div>
<h2  id="search_for_music2" class="nav_buttons"><label>Find Music</label></h2>
<div id="browse_music_box"></div>
<h2   id="search_for_music" class="nav_buttons" ><label>Search For Music</label></h2>
<div id="search_music_box"></div>
 <script>
 $.ajax({
         url:'torrent_all.php',
         success: function(response){
           $('#torrent_search_box').html(response)
         
         }
         
  });       
 function music_browser(folder){
    $.ajax({
    
           url:'music_browser.php',
           data: {folder: folder },
           success: function(response){
           
             $('#browse_music_box').html(response)
           }
 
    });
 }
 music_browser();
 search_music(1);
 function clear_playlist(){
   show_playlist(1, 1)
 
 }

 
$(document).ready(function(){
  $('#playlist').accordion();
  

});
</script>

