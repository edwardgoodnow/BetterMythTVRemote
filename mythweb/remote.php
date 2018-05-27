<?php error_reporting(E_ALL); ini_set('display_errors', 1); session_start(); ?>
<!DOCTYPE !html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>MythTV Web Remote</title>
<style>
/*
 * Style sheet (c) 2006 Steven Ellis <support@openmedia.co.nz>
 *
 * Published under http://creativecommons.org/licenses/by/2.5/
 */



body {
  background-color: #ededed;
  width: 100%;
  overflow-x: hidden;
}
    table {
    width: 320px!important;
    
    height: 100%!important;
}
.txt {
  background: #666;
  border-radius: 6px;
  margin: 0px;
  color: #fff;
  font-weight: bold;
  padding: 5px;
}
.controls {
  border: 1px solid #c2c2c2;
  border-radius: 5px;
  margin-top: 18px;
  padding: 10px;
  text-align: center;
  width: 88%;
  margin-bottom: 15px;
}
.image {
  width: 60px;
  margin: 5px;
}
.section2 {
  background-color: #ddd;
  border: 1px solid #c2c2c2;
  border-radius: 4px;
}


inspector-stylesheet:1
div#modal {
    position: absolute;
    top: 0;
    left: 0;
    background: #666;
    width: 100%;
    z-index: 100;
    color: #fff;
    /* list-style: none; */
}
ul.playlist {
  list-style: outside none none;
  margin: 5px;
  width: 90%;
}
.playlist li {
  background: #c2c2c2 none repeat scroll 0 0;
  border: 1px solid #eee;
  border-radius: 4px;
  box-shadow: 3px 3px 3px #ccc;
  font-size: 12px;
  margin-bottom: 5px;
  margin-left: -35px !important;
  padding: 5px;
  text-indent: 0;
  width: 95%;
  display: table;
}
#controls {
position:abolute;
z-index:1;
top:0px;
}
.sections {
  width: 95%;
}
.section2.navigation .image {
  width: 45px;
  margin: 0px;
}
.section2.navigation {
  display: inline-block;
  height: 163px;
  padding: 2px;
  vertical-align: top;
  width: 47%;
}
.section2.navigation .image:first-child {
  margin-top: 15px;
}
.section .number {
  width: 100px;
}
#modal {
  background: #666 none repeat scroll 0 0;
  color: #fff;
  height: auto;
  left: 0;
  margin: -5px;
  min-height: 100%;
  padding: 10px;
  position: absolute;
  text-indent: 10px;
  top: 0;
  width: 100%;
  z-index: 10;
  display: none;
}
#modal label {
  font-size: 12px;
  margin-left: 5px;
  display: block;
}
#artist {
  margin-left: 15px;
}
.playlist img {
  float: left;
  height: 30px;
  margin: 2px 5px 2px 2px;
  width: 30px;
}
.fa-window-close {
  position: absolute;
  right: 10px;
  top: 10px;
  font-size: 30px;
  color: red;
}

.keypad .txt {
  margin-top: 5px;
}
.playlist li img:last-child {
  cursor: pointer;
  float: right;
  position: relative;
  top: -15px;
}
.control_music {
  cursor: pointer;
  float: right !important;
  position: relative;
  top: -17px;
}
#modal > input {
  margin-left: 15px;
}
img[src="images/stream.png"] {
  width: 25px;
  height: 25px;
}
.sortby {
  display: none;
}
.viewswitch {
  display: none;
}
#search_music a[title="Order by Type"] {
  display: none;
}
abbr {
  display: none;
}
center {
  font-size: 11px;
  float: right;
  position: relative;
  top: 30px;
}
.detLink {
  font-size: 12px;
}
.torrent_results > img[src="//thepiratebay.org/static/img/icon_comment.gif"] {
  display: none;
}
.torrent_results img[src="//thepiratebay.org/static/img/vip.gif"] {
  display: none;
}
.torrent_results img[src="//thepiratebay.org/static/img/trusted.png"] {
  display: none;
}
.torrent_results a[title="Download this torrent using magnet"] {
  float: left;
  position: relative;
  top: 15px;
}
.detName {
  border-top: 1px solid;
  padding-top: 5px;
}
.torrent_results > a[title="More from this category"] {
  display: none;
}
a.detDesc {
  display: none;
}
#modal2 label {
  clear: both;
  display: block;
  font-size: 12px;
}
#modal2 {
  background-color: #666;
  display: none;
  height: auto;
  left: 0;
  min-height: 100%;
  padding: 10px;
  position: absolute;
  top: 0;
  z-index: 300;
}
.fa-window-close {
  color: red;
  font-size: 30px;
  position: absolute;
  right: 30px;
  top: 10px;
}
.border.white {
  background: #ededed none repeat scroll 0 0;
  border-radius: 5px;
  display: block;
  margin: 35px auto 5px;
  padding: 5px;
  width: 80%;
}
#artist {
  margin-left: 0px;
}
.border.white {
  background: #ededed none repeat scroll 0 0;
  border-radius: 5px;
  display: block;
  margin: 35px auto 5px 11px;
  padding: 11px;
  width: 83%;
  display: block;
}
#modal2 {
  background-color: #666;
  display: none;
  height: auto;
  left: 0;
  min-height: 100%;
  padding: 10px;
  position: absolute;
  top: 0;
  z-index: 300;
  width: 100%;
}
#play_stream {
  margin: 5px auto 5px 10px;
  width: 89%;
}
</style>

       <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />-->
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css" />
        <!--<link href="/public/css/fontastic.css" rel="stylesheet" />-->
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
 
	  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

 
	 
	  <link href="/public/js/lib/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	    
<script>
function add_to_playlist(song_id, action){
    $.ajax({
       url: 'playlist.php',
       type: 'post',
       data: { act: action, song_id: song_id },
       success: function(response){
          $('#playlist').html(response);
       }
  });     

}
function get_torrent(url, folder){
if(!folder){
$.ajax({
       url: url,
       type: 'get',
       data: { folder: 'music' },
       success: function(response){
          
       }
  });     
}else{
$.ajax({
       url: url,
       type: 'get',
       data: { folder: folder },
       success: function(response){
          
       }
  });   
}
}
function post_remote(action){

  $.ajax({
       url: 'remote_post.php',

       data: { submit: action },
       success: function(response){
          
       }
  });     
}

function play_song(id){

  $.ajax({
       url: 'remote_post.php',
    
       data: {submit: 'select track' , track: id },
       success: function(){
           
       }
  });
}
function show_playlist(id){
$.ajax({
       url: 'remote_post.php',
    
       data: {submit: 'Music' },
       success: function(){
           
       }
  });
  $.ajax({
       url: 'remote_playlist.php',
       type: 'post',
       data: {page: id , artist: $('#artist').val() },
       success: function(response){
            $('#modal').show();
            $('#modal').html('<p class="fas fa-window-close" onclick="$(\'#modal\').hide();"></p>' + response);
       }
  });
}
function stream(song_id){
  console.log('song.php?song_id=' + song_id);
           $('#play_stream').attr('src', 'song.php?song_id=' + song_id);
           document.getElementById('play_stream').play();
         

}
</script>
</head>

<body>
<div id="modal"></div>
<div id="modal2">
<div class="border white">
<p class="fas fa-window-close" onclick="$('#modal2').hide();"></p>
<label>Search By Artist</label>
<input id="artist" name="artist" value="" />
<label>Search By Song</label>
<input id="song" name="song" value="" />
<label>Search By Genre</label>
<input id="genre" name="genre" value="" />
</div>
<audio id="play_stream" src="" controls></audio>

<ul class="playlist" id="search_music">

  
</ul>
<script>
function search_music(p){
$.ajax({
              url: 'search_music.php?q=' + $('#artist').val() + '&page=' + p,
              success: function(response){
                $('#search_music').html(response);
                $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?url=' +$(this).attr('href'));
                 });  
              }
           });
 }          
$(document).ready(function(){
$('#search_for_music').click(function(){
 $.ajax({
              url: 'search_music.php?q=' + $('#artist').val(),
              success: function(response){
                $('#search_music').html(response);
                 $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?url=' +$(this).attr('href'));
                 });  
              }
           });
});
    $('#artist').bind('keyup touchend', function(ui){
    if(ui.which==13){
       $.ajax({
              url: 'search_music.php?q=' + $(this).val(),
              success: function(response){
                $('#search_music').html(response);
                 $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?url=' +$(this).attr('href'));
                 });  
              }
           });
           }
    });
    
});
</script>

<iframe src="" width="0" height="0" frameborder="no" id="torrent_frame"></iframe>
</div>
<div id="controls">
<div class="sections" style="text-align:center;margin-bottom:10px;">
         <input name="submit" onclick="show_playlist();" class="txt" value="Playlist" type="submit" />

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="TV" type="submit" />-->

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Music" type="submit" />-->

            <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Video" type="submit" />


         

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Recordings" type="submit" /> -->

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Guide" type="submit" /> -->

            <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Pictures" type="submit" />
</div>
<div class="controls">
    
<div class="section2">
                  <input alt="Record" name="submit" onclick=" post_remote($(this).val());" class="image" value="Rec" src="images/rec.png" type="image" /> 
<input alt="Play" name="submit" onclick=" post_remote($(this).val());" class="image" value="Play" src="images/right.png" type="image" /> 
                  <input alt="Stop" name="submit" onclick=" post_remote($(this).val());" class="image" value="Stop" src="images/stop.png" type="image" /> 

                  <input alt="Pause" name="submit" onclick=" post_remote($(this).val());" class="image" value="Pause" src="images/pause.png" type="image" /> 

       <br />
<input alt="Skip Back" name="submit" onclick=" post_remote($(this).val());" class="image" value="|&lt;" src="images/skip_back.png" type="image" />
                  <input alt="Rewind" name="submit" onclick=" post_remote($(this).val());" class="image" value="&lt;&lt;" src="images/fast_rewind.png" type="image" /> 

                  

                  

                  

                  <input alt="Fast Forward" name="submit" onclick=" post_remote($(this).val());" class="image" value="&gt;&gt;" src="images/fast_forward.png" type="image" /> 
  

                  <input alt="Skip Forward" name="submit" onclick=" post_remote($(this).val());" class="image" value="&gt;|" src="images/skip_forward.png" type="image" /> 
          </div>
            <br />
            <div class="section2 navigation">
            <input alt="Up" name="submit" onclick=" post_remote($(this).val());" class="image" value="U" src="images/up.png" type="image" /> 
          <br />
            <input alt="Left" name="submit" onclick=" post_remote($(this).val());" class="image" value="L" src="images/left.png" type="image" /> 

                  <input alt="OK" name="submit" onclick=" post_remote($(this).val());" class="image" value="OK" src="images/ok.png" type="image" /> 

                  <input alt="Right" name="submit" onclick=" post_remote($(this).val());" class="image" value="R" src="images/right.png" type="image" /> 
            <br />
            <input alt="Down" name="submit" onclick=" post_remote($(this).val());" class="image" value="D" src="images/down.png" type="image" /> 
         </div>




<div class="section2 navigation" style="text-align:center;margin-bottom:10px;">
            <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Mute" type="submit" />

            

          

            <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Back" type="submit" />

            <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Info" type="submit" />

            <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Menu" type="submit" />

          <br />
         

                  <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Vol Up" type="submit" />
                  
                   <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Vol Dn" type="submit" />
<br />
                  
             
                  

                  <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Page Up" type="submit" />
                    <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Page Dn" type="submit" />
                  

                  

                  

              

                 
</div>
                  

                  

<div class="section keypad" style="text-align:center;">                  

                  
    <div  id="keypad_numbers">
          <input name="submit" onclick=" post_remote($(this).val());" class="number" value="1" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="2" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="3" type="submit" />
                  <br/>
                    <input name="submit" onclick=" post_remote($(this).val());" class="number" value="4" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="5" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="6" type="submit" />
                    <br />
                   <input name="submit" onclick=" post_remote($(this).val());" class="number" value="7" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="8" type="submit" />

               
                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="9" type="submit" />
                    <br />
                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="*" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="0" type="submit" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="number" value="#" type="submit" />
                  
                 
       </div>  
       <div  id="keypad_letters">
       
       </div>
                <br />
               

                  <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Clear" type="submit" style="width:100px;" />

                  <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Enter" type="submit" style="width:100px;" />

   </div>          
</div>
</div>

</body>
</html>
