<?php
session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');

$row = mysqli_fetch_array(mysqli_query($conn, "select md.path, music_songs.filename from music_songs left join music_directories md on md.directory_id=music_songs.directory_id where song_id ='" . $_REQUEST['song_id'] . "' order by song_id desc limit 1"));
$ext = pathinfo('/mnt/storage/music/' . $row['path'] . '/' . $row['filename'], PATHINFO_EXTENSION);

header('content-type: audio/' . $ext);
echo file_get_contents('/mnt/storage/music/' . $row['path'] . '/' . $row['filename']);
