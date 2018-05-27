<?php 
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
?>
<style>
#cssmenu{padding:0;margin:0;border:0;}
#cssmenu ul,#cssmenu ul li,#cssmenu ul ul{list-style:none;margin:0;padding:0;border:0;}
#cssmenu ul{position:relative;z-index:397;}
#cssmenu ul li{min-height:1px;line-height:1em;vertical-align:middle;}
#cssmenu ul li:hover{position:relative;z-index:399;cursor:default;}
#cssmenu ul ul{visibility:hidden;position:absolute;top:100%;left:0;z-index:398;width:100%;}
#cssmenu ul ul ul{top:0px;left:99%;}
#cssmenu ul li:hover > ul{visibility:visible;}
#cssmenu ul ul{top:0px;left:99%;}

/* Custom CSS Styles */
#cssmenu ul{width:200px;background:#efefef;}
#cssmenu ul ul{width:150px;}
#cssmenu ul li{padding:7px 10px;color:#000;margin: 5px;}
#cssmenu ul li.hover,#cssmenu ul li:hover{background:#ccc;color:#fff;}
#cssmenu ul a:link,#cssmenu ul a:visited{color:#fff;text-decoration:none;}
#cssmenu ul a:hover{color:#000;}
#cssmenu ul a:active{color:#ffa500;}
#cssmenu p { float:right;clear:right; width:20px; height:20px; border:1px solid green;border-radius:4px;background-color:#fff; }
#cssmenu ul, #cssmenu ul ul {
	width: 20%;
	background: transparent;
}
#cssmenu ul li {
	padding: 7px 10px;
	color: #000;
	margin: 5px !important;
}
#cssmenu p {
	float: right;
	clear: right;
	width: 20px;
	height: 20px;
	border: 1px solid green;
	border-radius: 4px;
	background-color: #fff;
	vertical-align: top;
	display: block;
	margin-top: 0px;
	margin-bottom: 3px;
}

.artists_list, .albums_list {
	width: 92% !important;
	text-indent: 5px;
	
	
}
.artists_list li {
	left: 5px !important;
	position: relative;
}
.song_list {
display:none;

}
#cssmenu > ul {
background-color: #666!important;
	border: 2px solid #666!important;
	box-shadow: 6px 6px 6px #666!important;
	padding-right:35px;
	padding-bottom:10px;
}
.artists_list, .albums_list {
	max-height: 500px !important;
	overflow-y: auto !important;
	overflow-x: hidden !important;
	background-color: #666 !important;
	border: 2px solid #666 !important;
	box-shadow: 6px 6px 6px #666 !important;
	padding-right: 35px;
	padding-bottom: 10px;
	margin-left: 20px;
	margin-top: -5px;
	display: none;
	width: 70% !important;
	float: right;
	vertical-align: top;
	position: relative !important;
	top: -225px !important;
	clear: right;
}
.artists_list ul , .albums_list ul {
  width:98%!important;
  clear:both!important;
  display:block!important;
  position:static!important;
  margin-top:30px!important;
}
#cssmenu ul li > ul {
	visibility: visible;
}
#cssmenu ul li {
	padding: 7px 10px;
	color: #000;
	margin: 5px !important;
	height: 50px;
	vertical-align: middle;
}
#cssmenu li span {
	vertical-align: middle;
	top: 14px;
	position: relative;
}
.artists_list ul li, .albums_list ul li {
	background-color: #666;
	color: #fff !important;
}
.artists_list ul li:hover , .albums_list ul li:hover {
	background-color: #eee !important;
	color: #666 !important;
}
@media(max-width:400px){
  #cssmenu ul, #cssmenu ul ul {
	width: 83%;
	clear:both;
	background: transparent;
}
.artists_list, .albums_list {
float:none!important;
clear:both;
top:10px!important;
width:83%!important;
}
.artists_list ul li, .albums_list ul li {
left:-10px!important;
position:relative!important;
}
.playlist img {
	float: left;
	height: 45px;
	margin: 2px 5px 2px 2px;
	width: 45px;
}
}
</style>

<div id='cssmenu'>  
  <ul>
  
    <li ><span onclick="$('.artists_list').show();">Artists</span>
      
    </li>
    
    <li ><span onclick="$('.albums_list').show();">Albums</span>
         
        </li>
        
    <li><a href='#'><span>Genres</span></a>
        
        </li>
  </ul>
  <ul class="artists_list">
      <?php $sql = "select * from music_artists where artist_name !='' order by artist_name asc"; 
        $qry = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($qry)){
          ?>
        <li id="artist_<?php echo $row['artist_id']; ?>" data-artist="<?php echo $row['artist_id']; ?>"  class="select_artist"><span><?php echo $row['artist_name']; ?></span>   
        </li>
        <?php } ?>
        
      </ul>
  <ul class="albums_list">
            <?php $sql = "select * from music_albums where album_name !='' order by album_name asc"; 
                $qry = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($qry)){
                ?>
                <li id="album_<?php echo $row['album_id']; ?>" data-artist="<?php echo $row['album_id']; ?>"  class="select_album"><span><?php echo $row['album_name']; ?></span>   
                </li>
                <?php } ?>
          </ul>
</div>  
 <ul class="song_list">
  
  </ul>
<script>
$(document).ready(function(){
$('.select_artist').click(function(){
  id = $(this).attr('data-artist');
 
  aid = $(this).attr('data-album');
  
    elem = id?'#artist_' + id:'#album_'+ aid;
    if($(elem + ' ul li').length>0){
      return;
      }
    $(elem + ' ul').remove();
  $.ajax({
        url: 'get_songs.php',
        dataType: 'json',
        ajaxTimeout:5000,
        cache: false,
        data: { artist_id: $(this).attr('data-artist'), album_id: $(this).attr('data-album') },
        success: function(response){
        
         
            $(elem).append('<ul></ul>');
           $.each(response.data, function(i, item){
             if(item.name.length<1){
                $(elem + ' ul').append('<li><img src="get_art.php?song_id=' + item.song_id + '">' + item.filename + '<br>' + item.artist_name + '<br> <img class="control_music" src="images/right.png" onclick="play_song(' + item.song_id + ');"><img class="control_music" src="images/plus.png" onclick="add_to_playlist(' + item.song_id + ', \'add\');"><img class="control_music" src="images/stream.png" onclick="stream(' + item.song_id + ', \'add\');"></li>');
             }else{
                $(elem + ' ul').append('<li><img src="get_art.php?song_id=' + item.song_id + '">' + item.name + '<br>' + item.artist_name + '<br> <img class="control_music" src="images/right.png" onclick="play_song(' + item.song_id + ');"><img class="control_music" src="images/plus.png" onclick="add_to_playlist(' + item.song_id + ', \'add\');"><img class="control_music" src="images/stream.png" onclick="stream(' + item.song_id + ', \'add\');"></li>');
             }
           });
        }
   })     
})
})
</script>
