<?php
require('config.php');
?>
<!DOCTYPE !html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>MythTV Web Remote</title>

	 <link href="css/font-awesome.min.css" rel="stylesheet">
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
  display:none;
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
div#modal, #torrent_modal {
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
  top: -8px;
}
.detName {
  border-top: 1px solid;
  padding-top: 5px;
  margin-left:39px;
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
a.next.right {
    float: right;
    font-size: 16px;
    text-decoration: none;
    color: #fff;
    margin: 10px;
    background-color: darkred;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 2px 2px 2px #666;
    border: 1px solid #fff;
}
a.prev.left {
    float: left;
    font-size: 16px;
    text-decoration: none;
    color: #fff;
    margin: 10px;
    background-color: darkred;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 2px 2px 2px #666;
    border: 1px solid #fff;
}
li#search_for_music {
    text-align: center;
    font-size: 20px;
}
label#search_for_torrent {
    text-align: center;
    font-size: 20px;
    cursor:pointer;
}
div#torrent_stats {
    background-color: #fff;
    padding: 5px;
    border-radius: 5px;
    margin: 10px;
}
div#torrent_stats li {
    background-color: #ededed!important;
    color: #666!important;
}
div#torrent_stats li:first-child {
   color:red!important;
   background-color: #c2c2c2!important;
}
div#torrent_stats li:last-child {
 color:red!important;
 background-color: #c2c2c2!important;
}

div#torrent_stats .fa {
    float: left;
    display: inline-block;
    font-size: 20px;
    margin: 9px 5px;
    cursor: pointer;
}
div#torrent_stats li:last-child .fa {
display:none;
}
div#torrent_stats pre {
    display: inline-block;
    max-width: 90%;
    overflow: hidden;
    /* float: right; */
}
.nav_buttons {
    background-color: #ededed !important;
    color: #666;
font-family: arial;
}


#torrent_listings {

    width: 90% !important;
    background-color: #ededed;
    margin: 10px auto;
    border-radius: 10px;
    padding: 10px;
    border: 2px solid #fff;

}
.border.white input {
    width: 95%;
    margin: 5px auto !important;
}
#playlist {
    background-color: #e2e2e2 !important;
    text-align: center !important;
    padding: 10px;
    border-radius: 10px;
    margin: 0px auto;
    border: 2px solid #ccc;
}
.playlist li {
    background: #c2c2c2 none repeat scroll 0 0;
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 3px 3px 3px #ccc;
    font-size: 12px;
    margin-bottom: 5px;
    margin-left: auto!important;
    padding: 5px;
    text-indent: 0;
    width: 99%;
    display: table;
    margin-right: auto!important;
    text-align: left;
    font-size: 16px;
}
.border.white {
	background: #ededed none repeat scroll 0 0;
	border-radius: 5px;
	display: table;
	margin: 35px auto !important;
	padding: 11px;
	width: 90%;
	display: block;
	left: 0px !important;
	margin-left: auto !important;
	margin-right: auto !important;
}
#torrent_stats ul {
    margin: 5px auto !important;
    position: relative;
    left: -27px;
}
#play_stream {
	margin: 5px auto 15px auto !important;
	width: 90%;
	position: relative;
	display: block;
	left: -17px;
	border-radius: 5px;
	height: 40px;
	background-color: #eee;
	box-shadow: 3px 3px 3px #666 !important;
}
.border.white select {
	width: 95%;
	background-color: white;
	border: 1px solid #c2c2c2;
	font-size: 23px;
	border-radius: 4px;
}
.border.white input {
	width: 95%;
	margin: 5px auto !important;
	font-size: 26px;
}
#torrent_stats {
display:none;
}
p.show_downloads.fa.fa-toggle-down {
    font-size: 12px;
    color: #666;
    width: 150px;
    left: -151pz !important;
    float: right;
    display: block;
    clear: both;
    position: relative;
}
.fa.fa-cog.right {
	float: right;
	clear: both;
	display: block;
	margin-right: 30px;
	font-size: 40px;
	color: darkred;
	position: absolute;
	right: 0px;
	top: 10px;
}
.videos li {
	max-width: 125px;
	display: block;
	vertical-align: top;
	height: 205px;
	float: left;
	word-wrap: break-word;
	margin-left: 5px !important;
	margin-right: 0px !important;
	background-size: 100% auto;
	margin-top: 2px;
}
.video .title {
	text-align: center !important;
	width: 100% !important;
	display: block;
	font-size: 14px;
	margin-top: -55px;
	max-height: 65px !important;
	overflow: hidden;
	clear: both !important;
	padding: 5px;
}
.video .image {
	vertical-align: bottom !important;
	position: relative;
	bottom: -160px;
	width: 40px;
	left: -5px;
}
element {

}
#playlist {

    background-color: #e2e2e2 !important;
    text-align: center !important;
    padding: 10px;
    border-radius: 10px;
    margin: 0px auto;
    border: 2px solid #ccc;

}
ul.playlist.videos {

    list-style: outside none none;
    margin: 5px;
    width: 90%;
    text-align: left !important;
    text-indent: 0;

}
.video img[src="images/stream.png"] {
	width: 35px;
	height: 40px;
	position: relative;
	top: 160px;
	left: 45px;
	margin-bottom: -45px;
}
#playlist {
	display: table;
	width: 90%;
}
.video .title.games {
	text-align: center !important;
	width: 100% !important;
	display: block;
	font-size: 14px;
	margin-top: 10px;
	max-height: 65px !important;
	overflow: hidden;
	clear: both !important;
	padding: 5px;
}
.tagline {
	vertical-align: bottom;
	width: 100%;
	display: block;
	text-align: center;
}
.games .fa.fa-pencil {
	color: red;
	border: 1px solid;
	padding: 5px 3px;
	border-radius: 4px;
	background-color: #eee;
	position: relative;
	top: 120px;
}
#edit_data {
	width: 90%;
	background: #ededed;
	padding: 10px;
	color: #666;
	font-weight: bold;
	max-width: 300px;
	margin: 0 auto;
}
#edit_data .form-control {
	padding: 10px;
	max-width: 135px;
	display: inline-block;
}
#edit_data {
	width: 90%;
	background: #ededed;
	padding: 10px;
	color: #666;
	font-weight: bold;
	max-width: 300px;
	margin: 55px auto;
	border-radius: 10px;
	text-align: left !important;
	text-indent: 0px;
}
#edit_data .form-control {
	padding: 10px;
	max-width: 135px;
	display: inline-block;
}
.video .fa.fa-pencil {
	color: red;
	border: 1px solid;
	padding: 5px 3px;
	border-radius: 4px;
	position: relative;
	top: 155px;
	left: 50px;
	background: #ededed;
}
#scraper_data {
	position: absolute;
	right: 50px;
	background: #fff;
	z-index: 9999;
	display: inline-block;
	min-width: 300px;
	vertical-align: top;
	min-height: 300px;
	/* float: right; */
	top: 100px;
}
#scraper_data {
	position: absolute;
	right: 50px;
	background: #fff;
	z-index: 9999;
	display: none;
	min-width: 300px;
	vertical-align: top;
	min-height: 300px;
	/* float: right; */
	top: 70px;
	max-width: 200px;
	font-size: 12px;
	padding: 10px;
	word-wrap: break-word;
	border-radius:10px;
}
#scraper_data ul {
	list-style: none;
	margin-left:-30px;
}
#scraper_data label {
	font-weight: bold;
	float: left !important;
	margin-right: 10px;
}
#scraper_data li {
	margin-bottom: 10px;
}
#scraper_data li {
	margin-bottom: 10px;
	max-height: 90px;
	overflow: hidden;
}
#scraper_data .button {
	float: right;
	background-color: red;
	color: #fff;
	padding: 5px;
	border-radius: 5px;
	font-family: arial;
	border: 1px solid #fff;
	box-shadow: 2px 2px 2px #666;
}
.fa.fa-pencil {
	
	cursor: pointer;
}
.section2 {
	background-color: #ddd;
	border: 1px solid #c2c2c2;
	border-radius: 4px;
	text-align: center;
	margin: 5px auto;
	width: -moz-available;
}
.ui-accordion-header label {
	font-size: 24px !important;
	color: #666 !important;
	font-family: arial;
}
.ui-accordion-content {
	min-height: 500px;
	height: auto !important;
}
.ui-accordion-header {
	background-color: #c2c2c2 !important;
	padding: 8px;
	border-radius: 5px;
}
.ui-accordion-header-active {
	background-color: blue !important;
	padding: 8px;
	border-radius: 5px 5px 0px 0px;
	color: #fff !important;
}
.ui-accordion-header-active label {
color: #fff !important;
}
.border.white label {
	margin: 0 !important;
	color: #666;
	font-weight: bold;
	font-size: 15px !important;
	text-align: left;
	margin-left: 30px !important;
	font-family: arial;
}
.border.white {
	background: transparent;
	border-radius: 5px;
	display: table;
	margin: 35px auto !important;
	padding: 11px;
	width: 100%;
	display: block;
	left: 0px !important;
	margin-left: auto !important;
	margin-right: auto !important;
}
.in_playlist {
	background-color: goldenrod!important ;
}
#playlist_box ul li {
margin-left:-20px;
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
	
<script>
function add_to_playlist(song_id, action){
    $.ajax({
       url: 'playlist.php',
       type: 'post',
       data: { act: action, song_id: song_id },
       success: function(response){
          $('#playlist_box').html(response);
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
    
       data: {submit: 'play music track ' + id },
       success: function(){
           
       }
  });
}
function show_playlist(id, clr){
if(clr){

data = {page: id , artist: $('#search_music_box input').val(), clr: clr }
}else{
data = {page: id , artist: $('#search_music_box input').val() }
}
/*$.ajax({
       url: 'remote_post.php',
    
       data: {submit: 'Music' },
       success: function(){
           
       }
  });*/
  //change above to see if a song is already playing first
  $.ajax({
       url: 'remote_playlist.php',
       type: 'post',
       data: data,
       success: function(response){
            $('#modal').show();
            $('#modal').html('<p class="fa fa-window-close" onclick="$(\'#modal\').hide();"></p>' + response);
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
<i class="fa fa-cog right"></i>
<div id="modal"></div>
<div id="torrent_modal"></div>

<script>
function search_music(p){
$.ajax({
              url: 'search_music.php?q=' + $('#search_music_box input').val() + '&page=' + p,
              success: function(response){
                $('#search_music_box').html(response);
                $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                 }); 
                 $('#search_music_box input').bind('keyup touchend', function(ui){
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
                            success: function(response){
                                $('#search_music_box').html(response);
                                $('.torrent_link').bind('click touchend', function(ev){
                                ev.preventDefault();
                                get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                                });  
                            }
                        });
                        }
                    });                 
              }
           });
 }          
$(document).ready(function(){
$('#search_for_music').click(function(){
  $.ajax({
              url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
              success: function(response){
                $('#search_music_box').html(response);
                 $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                 }); 
                  $('#search_music_box input').bind('keyup touchend', function(ui){
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
                            success: function(response){
                                $('#search_music_box').html(response);
                                $('.torrent_link').bind('click touchend', function(ev){
                                ev.preventDefault();
                                get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                                });  
                            }
                        });
                        }
                    });                
              }
           });
});
$('#folder').change(function(){
        $.ajax({
              url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
              success: function(response){
                $('#search_music_box').html(response);
                 $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                 }); 
                 $('#search_music_box input').bind('keyup touchend', function(ui){
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
                            success: function(response){
                                $('#search_music_box').html(response);
                                $('.torrent_link').bind('click touchend', function(ev){
                                ev.preventDefault();
                                get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                                });  
                            }
                        });
                        }
                    });
              }
           });
});           
$('#search_music_box input').bind('keyup touchend', function(ui){
    if(ui.which==13){
       $.ajax({
              url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
              success: function(response){
                $('#search_music_box').html(response);
                 $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                 });  
                 $('#search_music_box input').bind('keyup touchend', function(ui){
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
                            success: function(response){
                                $('#search_music_box').html(response);
                                $('.torrent_link').bind('click touchend', function(ev){
                                ev.preventDefault();
                                get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                                });  
                            }
                        });
                        }
                    });
              }
           });
           }
    });
    
});
$('#search_for_torrent').bind('click touch', function(){
 $.ajax({
              url: 'search_music.php?q=' + $(this).val(),
              success: function(response){
                $('#search_music_box').html(response);
                 $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                 });  
                 $('#search_music_box input').bind('keyup touchend', function(ui){
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_music.php?folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
                            success: function(response){
                                $('#search_music_box').html(response);
                                $('.torrent_link').bind('click touchend', function(ev){
                                ev.preventDefault();
                                get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                                });  
                            }
                        });
                        }
                    });
              }
           });
});           
</script>
<script>
  function nav_playlist(n){
    $.ajax({
           url: '/playlist.php',
           data: { start: n },
           success: function(response){
             $('#playlist').html(response);
           }
     });
  }
  function show_downloads(){
    $('#modal').show();
    $.ajax({
           url: 'torrent_all.php?form=1',
           success: function(response){
              $('#modal').html(response);
            }      
        });    
  }
  function load_game_listings(){
     $.ajax({
           url: 'gplaylist.php',
           success: function(response){
             $('#modal').html(response);
             $('#modal').show();
           }
      });   
      }  
  function load_video_listings(){
     $.ajax({
           url: 'vplaylist.php',
           success: function(response){
             $('#modal').html(response);
             $('#modal').show();
           }
      });   
      }
</script> 
<iframe src="" width="0" height="0" frameborder="no" id="torrent_frame"></iframe>
</div>
<div id="controls">
<div class="sections" style="text-align:center;margin-bottom:10px;">
            <input name="submit" onclick="show_downloads();" class="txt" value="Downloads" type="submit" />
         <input name="submit" onclick="show_playlist();" class="txt" value="Music" type="submit" />

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="TV" type="submit" />-->

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Music" type="submit" />-->

            <input name="submit" onclick="javascript: load_video_listings(); " class="txt" value="Videos" type="submit" />


         

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Recordings" type="submit" /> -->

           <!-- <input name="submit" onclick=" post_remote($(this).val());" class="txt" value="Guide" type="submit" /> -->

            <input name="submit" onclick="javascript: load_picture_listings();" class="txt" value="Photos" type="submit" />
            
            <input name="submit" onclick="javascript: load_game_listings(); " class="txt" value="Games" type="submit" />
</div>

    
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

<script>
$('.show_downloads').toggle();
function edit_data(sect, id){
$.ajax({
        url: 'edit_data.php',
        data: {sect: sect, id:id},
        success: function(response){
         
          $('#modal2').show();
          $('#modal2').html(response);
          
        }  
  });
}
</script>
<div id="modal2">


<div class="playlist" id="search_music">

  
</div>
            
</div>

</body>
</html>
