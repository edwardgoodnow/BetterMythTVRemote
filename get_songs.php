<?php

set_time_limit(6000);
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');

if(!empty($_REQUEST['artist_id'])){

  $songs = array();
 // echo "select music_songs.name, music_songs.song_id from music_songs  where music_songs.artist_id=$_REQUEST[artist_id]";
            $qry = mysqli_query($conn, "select music_songs.song_id, music_songs.name, music_songs.filename, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id  where music_songs.artist_id=$_REQUEST[artist_id] order by music_songs.name, music_songs.filename");
            echo mysqli_error($conn);
            $i = 0;
            while($row = mysqli_fetch_array($qry)){
          
              $songs[$i] = $row;
              $i++;
            }
            
            echo json_encode(array('data' => $songs, 'sql' => "select music_songs.name, music_songs.song_id from music_songs  where music_songs.artist_id=$_REQUEST[artist_id]"));
 } 
