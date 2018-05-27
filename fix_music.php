<?php
session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
$qry = mysqli_query($conn, "select * from music_songs where directory_id=0");
while($row = mysqli_fetch_array($qry)){


}
