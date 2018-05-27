<?php
session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');

$query = mysqli_query($conn, "select * from music_albumart where song_id=" . $_GET['song_id'] . " order by albumart_id desc limit 1");
$songs = array();
$row= mysqli_fetch_array($query);


if(count($row)>0 & !empty($row['filename'])){
$ext = pathinfo('/mnt/MusicArt/AlbumArt/' . $row['filename'], PATHINFO_EXTENSION);
header('content-type: image/' . $ext);
$str= file_get_contents('/mnt/MusicArt/AlbumArt/' . $row['filename']);
}else{
header('content-type: image/jpg');
$str = file_get_contents('/mnt/MusicArt/mark.jpg');
}
if(empty($str)){
header('content-type: image/jpg');
$str = file_get_contents('/mnt/MusicArt/mark.jpg');
}
echo $str;
