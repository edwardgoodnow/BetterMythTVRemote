<?php
session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');

if(!empty($_REQUEST['act'])){

$row = mysqli_fetch_array(mysqli_query($conn, "select * from music_playlists where hostname = 'localhost.localdomain' and playlist_name='default_playlist_storage' order by playlist_id asc limit 1"));
if(count($row)==0){
   mysqli_query($conn, "insert into music_playlists values(null, 'default_playlist_storage', '', NOW(),'0', '0', 'localhost.localdomain');");

}
$songs = explode(",", $row['playlist_songs']);

 
 switch($_REQUEST['act']){
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

   mysqli_query($conn, "update music_playlists set playlist_songs='" . implode(",", $songs) . "', songcount='" . count($songs) . "', last_accessed=NOW() where hostname = 'localhost.localdomain' and playlist_name='default_playlist_storage' order by playlist_id asc limit 1");
}

$query = mysqli_query($conn, "select * from music_playlists where hostname = 'localhost.localdomain' and playlist_name='default_playlist_storage' order by playlist_id asc limit 1");
$songs = array();
while($row= mysqli_fetch_array($query)){


$songs = explode(',', $row['playlist_songs']);

foreach($songs as $k => $v){ 

//echo "select * from music_songs left join music_artists ma on ma.artist_id=music_artists.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id where song_id=$v";
  $qry = mysqli_query($conn, "select music_songs.song_id, music_songs.name, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id  where music_songs.song_id=$v");
  while($rowm = mysqli_fetch_array($qry)){
      echo "<li ><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" />" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "<br />" . $rowm['artist_name'] . " <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song('" . $rowm['song_id'] . "');\" /><img class=\"control_music\" src=\"images/minus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'remove');\" /></li>";
   
  }

}

}


echo mysqli_error($conn);
?>
<li onclick="javascript:$('#modal2').show();search_music(1);" id="search_for_music">Search For Music</li>
