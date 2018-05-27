<?php
ini_set('display_errors', 0);
require('config.php');
if($_REQUEST['q'] == 'undefined'){
    $_REQUEST['q'] = '';
}
if(empty($_REQUEST['playlist'])){
$chosen_playlist = 'default_playlist_storage';
}else{
$chosen_playlist = $_REQUEST['playlist'];
}
if(!empty($_REQUEST['clr'] )){
  mysqli_query($conn, "delete from music_playlists where playlist_name='$chosen_playlist'");
}
if(empty($_REQUEST['folder']) | @$_REQUEST['folder'] == 'music'){


if($_REQUEST['page'] == 'browse'){
require('music_browser.php');

exit;
}
if(empty($_REQUEST['page'])){
 $page=1;
 }else{
 $page= $_REQUEST['page'];
 }
 $s = ($page-1) * 5 ;
 $filter = ' ';
 if(!empty($_REQUEST['q'])){
   $filter .= "  where ma.artist_name like '%" . $_REQUEST['q'] . "%' or music_songs.name like '%" . $_REQUEST['q'] . "%'";
 }

$limit =5;

 $qry = mysqli_query($conn, "select music_songs.song_id from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id $filter");
 
 
 echo mysqli_error($conn);
 $total = mysqli_num_rows($qry);
 $pages = $total / 5;
 
 $qry = mysqli_query($conn, "select * from music_songs left join music_albums mal on mal.album_id=music_songs.album_id left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id $filter limit $s, $limit");
 }else{
  $total = 0;
  include('search_' . $_REQUEST['folder'] . '.php');
 
 }
 
 if($total==0 | @!empty($_REQUEST['torrents'])){
 if(empty($_REQUEST['torrents'])){
 ?>
 <p>No Local Results Found...searching torrent sites</p>
 <?php
  }
      include('torrent_init.php');
      exit;
       
 }
 if(!empty($_REQUEST['folder'])){
 
   //include('torrent_init.php');
 }
 ?>
 <div class="border white">
          
            <label>Search By Artist</label>
            <input id="artist" name="artist" value="<?php echo $_REQUEST['q']; ?>" />
            <label>Media Type</label>
            <select id="folder" name="folder">
            <option value="music">Music</option>
            <option value="videos">Videos</option>
            <option value="games">Games</option>
            </select>
            <label>Search By Song</label>
            <input id="song" name="song" value="<?php echo $_REQUEST['song']; ?>" />
            <label>Search By Genre</label>
            <input id="genre" name="genre" value="<?php echo $_REQUEST['genre']; ?>" />
 </div>           
 <?php           
 if(empty($_REQUEST['folder']) | @$_REQUEST['folder'] == 'music'){
  while($rowm = mysqli_fetch_array($qry)){
    $num_qry = mysqli_query($conn, "select * from music_playlists where playlist_name='$chosen_playlist' and playlist_songs like '%" . $rowm['song_id'] . "%'");
    $num_s =mysqli_num_rows($num_qry);
      echo "<li";
      
      if($num_s>0){
       echo " class=\"in_playlist\"";
      } 
      echo "><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" />" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "<br />" . $rowm['artist_name'] . '<br>' . $rowm['album'] . " <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" />";
      
      if($num_s>0){
      
      }else{
        echo "<img class=\"control_music\" src=\"images/plus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'add');\" />";
      }
      
      echo "<img class=\"control_music\" src=\"images/stream.png\" onclick=\"stream('" . $rowm['song_id'] . "', 'add');\" /></li></li>";
    
  }
  echo mysqli_error($conn);
  ?>
  <li class="nav_buttons">
   <?php if($page>1){?>
        <a href="javascript:;" class="prev left" onclick="search_music(<?php echo $page - 1; ?>);" style="float:left;">Prev</a>
  <?php } ?>
        <a href="javascript:;" class="next right" onclick="search_music(<?php echo $page + 1; ?>);" style="float:right;">Next</a>
  </li>
  
<?php 
exit;
}else{
if($_REQUEST['folder'] != 'video'){
  include('buttons_' . $_REQUEST['folder'] . '.php');
}
exit;
} ?>
  
