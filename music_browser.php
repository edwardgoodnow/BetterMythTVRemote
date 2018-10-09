<?php 
ini_set('display_errors', 0);
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
?>
<style>
.artists_list, .albums_list {
    max-height:500px;
    overflow-y:auto;
    width: auto !important;
    max-width: unset !important;
    display: none;

}
#cssmenu ul {

    width: 150px;
    float: left;
    margin-bottom: 66px;

}
.letters li {
    width: auto;
    display: inline-block;
}
</style>

<div id='cssmenu'>  
  <ul>
  
    <li ><span onclick="$('.albums_list').hide(); $('.artists_list').show();">Artists</span>
      
    </li>
    
    <li ><span onclick="$('.artists_list').hide(); $('.albums_list').show();">Albums</span>
         
        </li>
        
    <li><a href='#'><span>Genres</span></a>
        
        </li>
  </ul>
  <ul class="artists_list">
     <ol class="letters">
       <?php
        $letters = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
           foreach($letters as $letter){
           ?>
             <li ><a href="javascript:;" onclick="filter_artist('<?php echo $letter; ?>');" style="display:inline-flex;"><?php echo strtoupper($letter); ?></a></li>
        
          <?php
          
          }
        ?>
     
     </ol>
      <?php 
      
      
      $sql = "select * from music_artists where artist_name !='' and artist_name like '$_REQUEST[letter]%' order by artist_name asc"; 
      
        $qry = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($qry)){
          ?>
        <li id="list_<?php echo $row['artist_id']; ?>" class="artist_entry artist_<?php echo @$row['artist_id']; ?>"><span   data-artist="<?php echo $row['artist_id']; ?>" class=" select_artist"><?php echo $row['artist_name']; ?><img class="control_music" src="images/plus.png" onclick="add_artist_to_playlist(<?php echo $row['artist_id']; ?>, 'add');"></span>   
        </li>
        <?php } ?>
        
      </ul>
  <ul class="albums_list">
            <?php $sql = "select * from music_albums where album_name !='' order by album_name asc"; 
                $qry = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($qry)){
                
                ?>
                <li id="album_<?php echo $row['album_id']; ?>" data-artist="<?php echo $row['album_id']; ?>"  class="select_album"><span><?php echo @$row2['artist_name']; ?> - <?php echo $row['album_name']; ?></span>   
                </li>
                <?php } ?>
          </ul>
</div>  
 <ul class="song_list">
  
  </ul>

