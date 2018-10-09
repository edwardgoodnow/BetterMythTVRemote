<?php

set_time_limit(6000);
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
$offset = 0;
if(isset($_REQUEST['offset'])){
$offset = $_REQUEST['offset'] ;
}else{
$offset = 0;
}
$next = 0;

$total = mysqli_num_rows(mysqli_query($conn, "select music_songs.song_id, music_songs.name, music_songs.filename, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id  where music_songs.artist_id=$_REQUEST[artist_id]"));
if($total > $offset * 5){
$next = $offset +1;
}




  $songs = array();
 // echo "select music_songs.name, music_songs.song_id from music_songs  where music_songs.artist_id=$_REQUEST[artist_id]";
            $qry = mysqli_query($conn, "select music_songs.song_id, music_songs.name, music_songs.filename, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id  where music_songs.artist_id=$_REQUEST[artist_id] order by music_songs.name, music_songs.filename asc limit " . ($offset * 5) . ", 5");
            echo mysqli_error($conn);
            $i = 0;
            while($row = mysqli_fetch_array($qry)){
          
              $songs[$i] = $row;
              $i++;
            }
            
            echo json_encode(array('data' => $songs, 'total' => $total, 'aid' => $_REQUEST['artist_id'], 'offset' => @$_REQUEST['offset'] + 1, 'next' => @$next, 'prev' => @$prev, 'sql' => "select music_songs.song_id, music_songs.name, music_songs.filename, ma.artist_name from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id  where music_songs.artist_id=$_REQUEST[artist_id] order by music_songs.name, music_songs.filename asc limit " . ($offset + 5) . ", 5"));
 
