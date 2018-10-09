<?php
ini_set('display_errors', 0);
require('config.php');
if($_REQUEST['q'] == 'undefined'){
    $_REQUEST['q'] = '';
}
if(empty($_REQUEST['playlist'])){
$chosen_playlist = 'default_playlist_storage';
}else{
$chosen_playlist = $_REQUEST['playlist'];
}
if(!empty($_REQUEST['clr'] )){
  mysqli_query($conn, "delete from music_playlists where playlist_name='$chosen_playlist'");
}
if(empty($_REQUEST['folder']) | @$_REQUEST['folder'] == 'music'){


if($_REQUEST['page'] == 'browse'){
require('music_browser.php');

exit;
}
if(empty($_REQUEST['page'])){
 $page=1;
 }else{
 $page= $_REQUEST['page'];
 }
 $s = ($page-1) * 5 ;
 $filter = ' ';
 if(!empty($_REQUEST['q'])){
   $filter .= "  where ma.artist_name like '%" . $_REQUEST['q'] . "%' or music_songs.name like '%" . $_REQUEST['q'] . "%'";
 }

$limit =5;

 $qry = mysqli_query($conn, "select music_songs.song_id from music_songs left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id $filter");
 
 
 echo mysqli_error($conn);
 $total = mysqli_num_rows($qry);
 $pages = $total / 5;
 
 $qry = mysqli_query($conn, "select * from music_songs left join music_albums mal on mal.album_id=music_songs.album_id left join music_artists ma on ma.artist_id=music_songs.artist_id left join music_genres mg on mg.genre_id=music_songs.genre_id $filter limit $s, $limit");
 }else{
  $total = 0;
  include('search_' . $_REQUEST['folder'] . '.php');
 
 }
 
 if($total==0 | @!empty($_REQUEST['torrents'])){
 if(empty($_REQUEST['torrents'])){
 ?>
 <p>No Local Results Found...searching torrent sites</p>
 <?php
  }
      include('torrent_init.php');
      exit;
       
 }
 if(!empty($_REQUEST['folder'])){
 
   //include('torrent_init.php');
 }
 ?>
 <div class="border white">
          
            <label>Search By Artist</label>
            <input id="artist" name="artist" value="<?php echo $_REQUEST['q']; ?>" />
            <label>Media Type</label>
            <select id="folder" name="folder">
            <option value="music">Music</option>
            <option value="videos">Videos</option>
            <option value="games">Games</option>
            </select>
            <label>Search By Song</label>
            <input id="song" name="song" value="<?php echo $_REQUEST['song']; ?>" />
            <label>Search By Genre</label>
            <input id="genre" name="genre" value="<?php echo $_REQUEST['genre']; ?>" />
 </div>  
 <script>
 

function play_song_from_search(id , which){
$('#play_stream').remove();
$('#song_in_search_' + id).prepend('<span id="music_stream"><audio id="play_stream" autobuffer controls autoplay><source src="" /></audio> <img id="player_image" style="float:right;width:25%;height:auto;max-width:150px;" src="" /><span id="player_artist_name"></span><br /><span id="player_song_name"></span><br /><span id="player_genre"></span></span>');
if(!which){
  $('#song_in_search_' + id + ' img[src="images/right.png"]').qtip({ position: { my: 'top right', at : 'bottom left'}, content: { text: '<ul><li style="font-size:14px; margin-bottom: 20px;cursor:pointer;" onclick="play_song_from_search(' + id + ' , \'local\');">Play Locally</li><li onclick="play_song_from_search(' + id + ' , \'server\');" style="font-size:14px; margin-bottom: 20px;cursor:pointer;">Play on Server</li></ul>' }, show: { ready: true }, hide: function(ui){ ui.mouseleave } });

  return;
}else if(which == 'server' | $('#which_device').val() == 'server'){

        $.ajax({
            url: 'remote_post.php',
            
            data: {submit: 'jump musicplaylists' },
            success: function(){
                
            }
        });
        $.ajax({
            url: 'remote_post.php',
            
            data: {submit: 'play music track ' + id },
            success: function(){
                $('#player_song_name').html($('#song_in_search_' +  id + ' .song_name').html())
                $('#player_artist_name').html($('#song_in_search_' +  id + ' .artist_name').html())
                $('#player_genre').html($('#song_in_search_' + id + '  .genre').html())
                $('#player_image').attr('src', $('#song_in_search_' +  id + ' img').attr('src'));
            }
        });
 }else{

    $.ajax({
           url: 'song.php?song_id=' + id,
           dataType: 'json',
           success: function(response){
                if(!response.msg){
                
                 $('li.playing').removeClass('playing').addClass('played');
                 $('li').removeClass('playing');
                 $('li[title="' + id + '"]').addClass('playing');
                    $('#play_stream source').attr('src', 'song_play.php?play=1&song_id=' + response.song_id);
                        $('#play_stream').load();
                            document.getElementById('play_stream').play();
                            $('#player_song_name').html($('#song_in_search_' +  id + ' .song_name').html())
                            $('#player_artist_name').html($('#song_in_search_' +  id + ' .artist_name').html())
                            $('#player_genre').html($('#song_in_search_' + id + '  .genre').html())
                            $('#player_image').attr('src', $('#song_in_search_' +  id + ' img').attr('src'));
                }else{
                    alert(response.msg);
                }
           }
    });       
 }
}
</script>
 <?php           
 if(empty($_REQUEST['folder']) | @$_REQUEST['folder'] == 'music'){
 $artists = array();
  while($rowm = mysqli_fetch_array($qry)){
  
  if(!in_array($rowm['artist_name'], $artists)){
     echo "<li class=\"artist_" . $rowm['artist_id'] . "\">" . $rowm['artist_name'] . "<img class=\"control_music\" src=\"images/plus.png\" onclick=\"add_artist_to_playlist('" . $rowm['artist_id'] . "', 'add');\" /></li>";
     $artists[] = $rowm['artist_name'];
  }
    $num_qry = mysqli_query($conn, "select * from music_playlists where playlist_name='$chosen_playlist' and playlist_songs like '%" . $rowm['song_id'] . "%'");
    $num_s =mysqli_num_rows($num_qry);
      echo "<li id=\"song_in_search_"  . $rowm['song_id'] . "\" class=\"";
      
      if($num_s>0){
       echo "in_playlist";
      } 
      echo " song_entry_" . $rowm['song_id'] . "\"><img src=\"get_art.php?song_id=" . $rowm['song_id'] . "&_" . time() . "\" /><span class=\"song_name\">" . str_replace('/mnt/storage/music/0 - _mnt_storage_music_0 - _mnt_storage_music_', '', $rowm['name']) . "</span><br /><span class=\"artist_name\">" . $rowm['artist_name'] . "</span><br /><span class=\"genre\">" . $rowm['genre'] . "</span> <img class=\"control_music\" src=\"images/right.png\" onclick=\"play_song_from_search('" . $rowm['song_id'] . "');\" />";
      
      if($num_s>0){
      
      }else{
        echo "<img class=\"control_music\" src=\"images/plus.png\" onclick=\"add_to_playlist('" . $rowm['song_id'] . "', 'add');\" />";
      }
      
      echo "s</li></li>";
    
  }
  echo mysqli_error($conn);
  ?>
  <li class="nav_buttons">
   <?php if($page>1){?>
        <a href="javascript:;" class="prev left" onclick="search_music(<?php echo $page - 1; ?>);" style="float:left;">Prev</a>
  <?php } ?>
        <a href="javascript:;" class="next right" onclick="search_music(<?php echo $page + 1; ?>);" style="float:right;">Next</a>
  </li>
  
<?php 
exit;
}else{
if($_REQUEST['folder'] != 'video'){
  include('buttons_' . $_REQUEST['folder'] . '.php');
}
exit;
} ?>
  
