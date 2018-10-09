<?php
@session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
if(empty($_REQUEST['playlist'])){
$chosen_playlist = '';
}else{
$chosen_playlist = $_REQUEST['playlist'];
}
if(!empty($_POST['clr'] )){
  mysqli_query($conn, "update music_playlists set playlist_songs='', songcount=0, last_accessed=NOW()  where playlist_name='$chosen_playlist'");
}
if(!empty($_POST['artist_id'])){
 
}
if(!empty($_POST['act'])){

$row = mysqli_fetch_array(mysqli_query($conn, "select * from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1"));

if(count($row)==0){
   mysqli_query($conn, "insert into music_playlists values(null, '$chosen_playlist', '', NOW(),'0', '0', 'localhost.localdomain');");

}
$songs = explode(",", $row['playlist_songs']);

// print_r($songs);
// exit;
 switch($_POST['act']){
    case('remove'):
     foreach ($songs as $key => $value) {
          if($value==$_REQUEST['song_id']){
            unset($songs[$key]);
            //$songs[$key] = null;
          
          }
        }
         mysqli_query($conn, "update music_playlists set playlist_songs='" . implode(",", $songs) . "', songcount='" . count($songs) . "', last_accessed=NOW() where  playlist_name='$chosen_playlist' order by playlist_id asc limit 1");
    break;
    case('add'):
      if(empty($_POST['artist_id'])){
        foreach ($songs as $key => $value) {
            if($value==$_REQUEST['song_id']){
            
            }else {
            array_push($songs,$_REQUEST['song_id']);
            }
        }     
        
        
         mysqli_query($conn, "update music_playlists set playlist_songs='" . implode(",", $songs) . "', songcount='" . count($songs) . "', last_accessed=NOW() where  playlist_name='$chosen_playlist' order by playlist_id asc limit 1");
         
         
      }else{
        $qry = mysqli_query($conn, "select song_id from music_songs where artist_id=" . $_REQUEST['artist_id']);
        $songs_out=array();
        while($rowm = mysqli_fetch_array($qry)){
            $songs_out[] = $rowm['song_id'];
        }
        $songs_out2 = implode(',', $songs_out);
        $row = mysqli_fetch_array(mysqli_query($conn, "select playlist_songs from music_playlists where playlist_name='$chosen_playlist' order by playlist_id asc limit 1"));
      // echo $songs_out2;
  
        $songs = $songs_out2 . ',' . rtrim($row['playlist_songs'], ',');
        
        $songcount = count(explode(',', $songs));
      // echo "update music_playlists set playlist_songs ='$songs', songcount=$songcount where playlist_name='$chosen_playlist' order by playlist_id asc limit 1";
        mysqli_query($conn, "update music_playlists set playlist_songs ='$songs', songcount=$songcount, last_accessed=NOW() where playlist_name='$chosen_playlist' order by playlist_id asc limit 1");
    
      }
    break;
    case('edit'):
    
    break;
    case('info'):
    
    break;

}

  
}

            
            if(!empty($_POST['song_id'])){
               $data = mysqli_fetch_array(mysqli_query($conn, "select * from music_songs where song_id=" . $_POST['song_id']));
               $msg = 'Added ' . $data['name'];
            
            }
            if(!empty($_POST['artist_id'])){
              $data = mysqli_fetch_array(mysqli_query($conn, "select * from music_artists where artist_id=" . $_POST['artist_id'] . " order by artist_id desc limit 1"));
               $msg = 'Added ' . $data['artist_name'];
            
            }
            
            ?>


    <h2><label>Playlist</label></h2>
        <div id="playlist_box">
            <span id="chooser_buttons">
                <i class="fa fa-music inline" aria-hidden="true" title="Create Playlist" onclick="return create_playlist();" style="padding:5px; background-color:#666; color:#fff;border-radius:5px;margin-right:5px;text-align:center;"></i>
                <i class="fa fa-binoculars inline" aria-hidden="true" title="Load Playlist" onclick="load_playlist();" style="padding:5px; background-color:#666; color:#fff;border-radius:5px;margin-right:5px;text-align:center;"></i>

            <span id="chooser" style="float:right;">
                <label style="float:left;">Play On:</label>

                        <select name="chosen_device" id="chosen_device">
                            <option value="local" selected>Local</option>
                            <option value="server">Server</option>
                        </select>
            </span>   
            </span>

                <ul id="master_list">

                </ul>
        </div>       
        
       
    <h2  id="search_for_music2" class="nav_buttons"><label>Find Music</label></h2>
        <div id="browse_music_box"></div>
    <h2   id="search_for_music" class="nav_buttons" ><label>Search For Music</label></h2>
        <div id="search_music_box"></div>

    <h2 id="torrent_search_header" ><label id="search_for_torrent">Torrent Search</label></h2>
        <div id="torrent_search_box"></div>
  
