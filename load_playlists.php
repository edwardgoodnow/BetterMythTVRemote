<?php
@session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
if(empty($_REQUEST['playlist_name'])){
?>
<ul>
<?php 

$query = mysqli_query($conn, "select * from music_playlists");
while($row = mysqli_fetch_array($query)){
  ?>
  <li id="playlist_<?php echo $row['playlist_id']; ?>" alt="<?php echo $row['playlist_name']; ?>"><label classs="inline" ><?php echo $row['playlist_name']; ?></label>
     <i class="fa fa-eye control_music inline" onclick="load_playlist_locally('<?php echo $row['playlist_name']; ?>', <?php echo $row['playlist_id']; ?>);"></i>
     <i class="fa fa-play control_music inline" onclick="load_playlist_server('<?php echo $row['playlist_name']; ?>');"></i>
     <ul id="playlist_<?php echo $row['playlist_id']; ?>"></ul>
  </li>   
  <?php
}
}else{
$chosen_playlist = $_REQUEST['playlist_name'];
include("songs_from_list.php");


?>
</ul>

<?php } ?>
<script>

</script>
