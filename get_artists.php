<?php
session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');


if(empty($_REQUEST['page'])){
 $page=1;
 }else{
 $page= $_REQUEST['page'];
 }
 $s = $page-1 ;
 if(!empty($_REQUEST['artist'])){
   $filter = " and artist_id=" . $_REQUEST['artist'];
 }

$limit =100;

 $qry = mysqli_query($conn, "select * from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id where ma.artist_name like '%" . $_REQUEST['q'] . "'");
 $total = mysqli_num_rows($qry);
 $pages = $total / 100;
  if($total==0){
        include('torrent_init.php');
        exit;
 }
 $qry = mysqli_query($conn, "select * from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id where ma.artist_name like '%" . $_REQUEST['q'] . "%' limit $s, $limit");
  while($rowm = mysqli_fetch_array($qry)){
      echo "<li ><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" />" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "<br />" . $rowm['artist_name'] . " <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" /><img class=\"control_music\" src=\"images/plus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'add');\" /><img class=\"control_music\" src=\"images/stream.png\" onclick=\"stream('" . $rowm['song_id'] . "', 'add');\" /></li>";
   
  }
  
  ?>
  <li>
   <?php if($page>1){?>
  <p onclick="show_playlist(<?php echo $page - 1; ?>);" style="float:left;">Prev</p>
  <?php } ?>
  <p onclick="show_playlist(<?php echo $page + 1; ?>);" style="float:right;">Next</p>
  </li>
