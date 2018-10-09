<?php
session_start();
header('content-type: application/json');
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
$html5 = array('mp3', 'wav', 'ogg');
$row = mysqli_fetch_array(mysqli_query($conn, "select md.path, music_songs.filename, music_songs.song_id from music_songs left join music_directories md on md.directory_id=music_songs.directory_id where song_id ='" . $_REQUEST['song_id'] . "' order by song_id desc limit 1"));

$ext = pathinfo('/mnt/storage/music/' . $row['path'] . '/' . $row['filename'], PATHINFO_EXTENSION);


if(!in_array($ext, $html5)){
 shell_exec("ffmpeg -i '/mnt/storage/music/" . $row['path'] . "/" . $row['filename'] . "' -vn -ar 44100 -ac 2 -ab 192k -f mp3 '/mnt/storage/music/" . $row['path'] . "/" . $row['filename'] . ".mp3'");
 mysqli_query($conn, "update music_songs set filename='" . $row['filename'] . ".mp3' where song_id=" . $row['song_id']);
 echo json_encode(array('msg' => 'Converting ' . $row['filename'] . ' to MP3')); 
}else{
 echo json_encode(array('song_id' => $_REQUEST['song_id']));

}
