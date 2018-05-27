<?php
session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
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
 
 $qry = mysqli_query($conn, "select * from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id $filter limit $s, $limit");
 
 
 if($total==0 | @$_REQUEST['torrents'] == true){
 if(empty($_REQUEST['torrents'])){
 ?>
 <p>No Local Results Found...searching torrent sites</p>
 <?php
  }
      include('torrent_init.php');
        exit;
 }
  while($rowm = mysqli_fetch_array($qry)){
      echo "<li><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" />" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "<br />" . $rowm['artist_name'] . " <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" /><img class=\"control_music\" src=\"images/plus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'add');\" /><img class=\"control_music\" src=\"images/stream.png\" onclick=\"stream('" . $rowm['song_id'] . "', 'add');\" /></li></li>";
   
  }
  echo mysqli_error($conn);
  ?>
  <li class="nav_buttons">
   <?php if($page>1){?>
        <a href="javascript:;" class="prev left" onclick="search_music(<?php echo $page - 1; ?>);" style="float:left;">Prev</a>
  <?php } ?>
        <a href="javascript:;" class="next right" onclick="search_music(<?php echo $page + 1; ?>);" style="float:right;">Next</a>
  </li>
  <li class="nav_buttons">
     <label id="search_for_torrent">Torrent Results</label>
     <?php
        include('torrent_init.php');
     ?>
  </li>   
