<?php 
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
?>
<ul>
  <?php
      $qry = mysqli_query($conn, "select * from music_playlists");
      while($row  = mysqli_fetch_array($qry)){
        ?><li onclick="add_artist_to_playlist(<?php echo $_REQUEST['artist_id']; ?>, 'add', '<?php echo $row['playlist_name']; ?>');"><?php echo $row['playlist_name']; ?></li><?php
      }
  ?>  
</ul>