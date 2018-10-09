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
    <link href="css/styles.css" rel="stylesheet">

        <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />-->
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css" />
        <!--<link href="/public/css/fontastic.css" rel="stylesheet" />-->
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
 
	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

 
	 
	    <link href="/public/js/lib/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet">
	    <script src="streamingMusicTest/streaming/node_modules/socket.io-client/dist/socket.io.js"></script>
<script>
 // const socket = io('http://<?php echo $_SERVER['SERVER_NAME']; ?>');
 const socket = io('//?token=abc', {
 
  path: '/socket.io'
});
setTimeout(function(){
socket.emit('command', {cmd: 'play music'});
}, 3000);
</script>
<style>
.artist_entry ul {
    background: red;
    max-width: unset!important;
    width: 97%!important;
}
    .sections.nav_buttons {
        top: 50px;
        position:relative;
}
.fa.fa-cog.right {
    float: right;
    clear: both;
    display: block;
    margin-right: 30px;
    font-size: 40px;
    color: darkred;
    position: absolute;
    right: -25px;
    top: 0px;

}
.section2 {
    background-color: #ddd;
    border: 1px solid #c2c2c2;
    border-radius: 4px;
    text-align: center;
    margin: 5px auto;
    width: -moz-available;
    position: relative;
    top: 55px;
}
.section.keypad {
    position: relative;
    top: 55px;
}
.fa.fa-microphone {
    position: fixed;
    bottom: 10px;
    right: 30px;
    z-index: 10000000;
    font-size: 45px;
    color: darkgreen;
}
.right {
    float: right;
    margin-right: 20px;
    font-size: 45px;
    margin-top: 20px;
    color: green;
}
@media(max-width: 600px){
#playlist {
    display: table;
    width: 99%;
    margin-left: -14px!important;
    margin-top: 50px;
}
#cssmenu ul {
    width: 98%!important;
    float: left;
    margin-bottom: 66px;
}
ol.letters {
    width: 100%;
    margin-left: -40px;
}
.fa-window-close {
    color: red;
    font-size: 39px;
    position: absolute;
    right: 30px;
    top: -25px;
}
#playlist ul {
    text-align: center !important;
    padding: 10px 10px 10px 12px;
    margin: 0px auto 0 -12px !important;
    width: 99%;
}
#play_stream {
    margin: 5px auto 15px 20px !important;
    width: 100%;
    position: relative;
    display: block;
    left: -17px;
    border-radius: 5px;
    height: 40px;
    background-color: #eee;
    box-shadow: 3px 3px 3px #666 !important;
}
select#chosen_device {
    margin-right: 15px;
}
span#chooser label {
    color: #666;
    font-weight: bold;
    font-family: Helvetica;
}

.border.white {
    background: transparent;
    border-radius: 5px;
    display: table;
    margin: 35px auto 35px 0px !important;
    padding: 11px;
    width: 95%;
    display: block;
    left: 0px !important;
    margin-left: auto !important;
    margin-right: auto !important;
}
div#search_music_box {
    width: 98%;
}
.playlist li img[src="images/plus.png"] {
    cursor: pointer;
    float: right;
    position: relative;
    top: -1px;
}
}
.playlist #cssmenu ul:first-child > li {
    font-size: 25px;
    /* width: 99%; */
}
* {
 font-family: Helvetica;
}
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.js"></script>

<script>
function filter_artist(letter){
  $.ajax({
            url:'/music_browser.php?letter=' + letter,
            success: function(response){
             $('#browse_music_box').html(response)
             $('.artists_list').attr('style', 'display:block');
            }
   });
}
function create_playlist_now(){
  create_playlist($('#playlist_name').val())
  }
function create_playlist(list_name){
  if(!list_name){
     $('#playlist_creator').html('<label>Playlist Name</label><input type="text" id="playlist_name" value="" class="inline" /><input type="submit" class="inline button" onclick="create_playlist_now();" />');
  
  }else{
        if(list_name.length < 5){
          alert('Please use a name longer than 5 characters');
        }else{
        
          $.ajax({
                url: 'create_playlist.php',
                data: { name: list_name, playlist: list_name },
                success: function(response){
                    $('#master_list').html(response);
                     $('#playlist_name_chooser').val(name);
                }
           });     
        }
  }
}

var load_playlist = function(name){
console.log(name)
   if(!name){
      $.ajax({
                url: 'load_playlists.php',
                
                success: function(response){
                    $('#master_list').html(response);
                }
           });     
   
   }else{
        $.ajax({
                url: 'create_playlist.php',
                data: { playlist: name },
                success: function(response){
                    $('#master_list').html(response);
                    $('#playlist_name_chooser').val(name);
                }
           });     
   
   }
}
function playlists_tooltip(song_id){
//if($('#chosen_device').length==0){
$.ajax({
       url: 'playlist_choices.php',
       type: 'post',
       data: {  song_id: song_id },
       success: function(response){
          $('.song_entry_' + song_id + ' img[src="images/plus.png"]').qtip({ content: { text: response }, show: { ready: true }, position: { my: 'top right', at: 'bottom left'}, hide: function(ui){ ui.mouseleave}});
          
       }
  });     
 // }else{
  //  play_song(song_id);
  
  //}
}
function add_artist_to_playlist(aid, act, plist){
  if(!plist){
        $.ajax({
            url: 'playlist_choices_artist.php',
            type: 'post',
            data: {  artist_id: aid },
            success: function(response){
            //class=\"artist_" . $rowm['artist_id'] . "\">
                $('.artist_' + aid + ' img[src="images/plus.png"]').qtip({ content: { text: response }, show: { ready: true }, position: { my: 'top right', at: 'bottom left'}, hide: function(ui){ ui.mouseleave}});
            }
        });     
  
  }else{
      $.ajax({
            url: 'playlist.php',
            type: 'post',
            data: {  artist_id: aid, playlist: plist, act: act },
            success: function(response){
                
            }
        });     
  }
}
function add_to_playlist(song_id, action, plist){

 if(!plist){
 
   playlists_tooltip(song_id);
   return;
 }
    $.ajax({
       url: 'playlist.php',
       type: 'post',
       data: { act: action, song_id: song_id, playlist: plist },
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

function play_song(id , which){



if($('#chosen_device').length>0){
  which = $('#chosen_device option:selected').val()
  
}

if(!which){
  $('#song_' + id + ' img[src="images/right.png"]').qtip({ position: { my: 'top right', at : 'bottom left'}, content: { text: '<ul><li style="font-size:14px; margin-bottom: 20px;cursor:pointer;" onclick="play_song(' + id + ' , \'local\');">Play Locally</li><li onclick="play_song(' + id + ' , \'server\');" style="font-size:14px; margin-bottom: 20px;cursor:pointer;">Play on Server</li></ul>' }, show: { ready: true }, hide: function(ui){ ui.mouseleave } });

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
                $('#player_song_name').html($('#song_' +  id + ' .song_name').html())
                $('#player_artist_name').html($('#song_' +  id + ' .artist_name').html())
                $('#player_genre').html($('#song_' + id + '  .genre').html())
                $('#player_image').attr('src', $('#song_' +  id + ' imgfirst-child').attr('src'));
            }
        });
 }else{
   $('#music_stream').remove();
   $('.song_entry_' + id).parent().prepend('<span id="music_stream"><audio id="play_stream" autobuffer controls autoplay><source src="" /></audio> <img id="player_image" style="float:right;width:25%;height:auto;max-width:150px;" src="" /><span id="player_artist_name"></span><br /><span id="player_song_name"></span><br /><span id="player_genre"></span></span>');
    
    
    $.ajax({
           url: 'song.php?song_id=' + id,
           dataType: 'json',
           success: function(response){
                if(!response.msg){
                
                 $('li.playing').removeClass('playing').addClass('played');
                 $('li').removeClass('playing');
                 $('li[title="' + id + '"]').addClass('playing');
                    $('#play_stream source').attr('src', '/music_stream/?id=' + response.song_id);
                        $('#play_stream').load();
                            document.getElementById('play_stream').play();
                            $('#player_song_name').html($('#song_' +  id + ' .song_name').html())
                            $('#player_artist_name').html($('#song_' +  id + ' .artist_name').html())
                            $('#player_genre').html($('#song_' + id + '  .genre').html())
                            $('#player_image').attr('src', $('#song_' +  id + ' img:first-child').attr('src'));
                }else{
                    alert(response.msg);
                }
           }
    });       
 }
 //setTimeout(function(){
    annyang.abort();
    
        $('.fa-microphone').css('color', 'green');
   //  }, 1000);   
}
 function clear_playlist(plist){
 $.ajax({
       url: 'playlist.php',
       type: 'post',
       data: { clr: 1, playlist: plist },
       success: function(response){
            show_playlist(1, 1)
       }
   });    
 }
  function music_browser2(offset, aid){
if(offset){

    id = aid;
                     
                     
                        
                            elem = '.artist_' + id;
                           if($(elem + ' ul').length==0){
                                    $(elem).append('<ul></ul>');
                                 }   
                                  $(elem + ' .nav_tabs').remove();  
                            
                            
                        $.ajax({
                                url: 'get_songs.php',
                                dataType: 'json',
                                ajaxTimeout:5000,
                                cache: false,
                                data: { artist_id: aid, offset: offset },
                                success: function(response){
                           
                                
                                            $.each(response.data, function(i, item){
                                           
                                                if(item.name.length<1){
                                                    $(elem + ' ul').append('<li class=" song_entry_' + item.song_id + '"><img src="get_art.php?song_id=' + item.song_id + '">' + item.filename + '<br>' + item.artist_name + '<br> <img class="control_music" src="images/right.png" onclick="play_song(' + item.song_id + ');"><img class="control_music" src="images/plus.png" onclick="add_to_playlist(' + item.song_id + ', \'add\');"><img class="control_music" src="images/stream.png" onclick="stream(' + item.song_id + ', \'add\');"></li>');
                                                }else{
                                                    $(elem + ' ul').append('<li class=" song_entry_' + item.song_id + '"><img src="get_art.php?song_id=' + item.song_id + '">' + item.name + '<br>' + item.artist_name + '<br> <img class="control_music" src="images/right.png" onclick="play_song(' + item.song_id + ');"><img class="control_music" src="images/plus.png" onclick="add_to_playlist(' + item.song_id + ', \'add\');"><img class="control_music" src="images/stream.png" onclick="stream(' + item.song_id + ', \'add\');"></li>');
                                                }
                                            });
                                        $(elem + ' ul').append('<li class="nav_tabs"></li>');
                                        
                                            if(response.next>0){
                                              $(elem + ' ul .nav_tabs').append('<span  class="nav" onclick="music_browser2(' + response.next + ', ' + response.aid +');" style="float:right;display:inline-block;">Next</span>');
                                            }
                                            if(response.prev & response.offset>0){
                                              $(elem + ' ul .nav_tabs').append('<span class="nav" onclick="music_browser2(' + response.prev + ', ' + response.aid +');" style="float:left;display:inline-block;">Prev</span>');
                                            }
                                            return;
                                }
                                
                        }) 
return;
}
return;
}
 function music_browser(offset, aid){

    $.ajax({
    
           url:'music_browser.php',
           data: { offset: offset },
           success: function(response){
           
             $('#browse_music_box').html(response)
             $('.select_artist').click(function(){
                        id = aid?aid:$(this).attr('data-artist');
                     
                        aid = $(this).attr('data-album');
                        
                            elem = id?'.artist_' + id:'#album_'+ aid;
                
                            if($(elem + ' ul li').length>0){
                                  $(elem + ' li.nav_tabs').remove();  
                            }
                            
                        $.ajax({
                                url: 'get_songs.php',
                                dataType: 'json',
                                ajaxTimeout:5000,
                                cache: false,
                                data: { artist_id: $(this).attr('data-artist'), album_id: $(this).attr('data-album') },
                                success: function(response){
                           
                                 if($(elem + ' ul').length==0){
                                    $(elem).append('<ul></ul>');
                                 }   
                                            $.each(response.data, function(i, item){
                                            console.log(item.name)
                                                if(item.name.length<1){
                                                    $(elem + ' ul').append('<li class=" song_entry_' + item.song_id + '"><img src="get_art.php?song_id=' + item.song_id + '">' + item.filename + '<br>' + item.artist_name + '<br> <img class="control_music" src="images/right.png" onclick="play_song(' + item.song_id + ');"><img class="control_music" src="images/plus.png" onclick="add_to_playlist(' + item.song_id + ', \'add\');"><img class="control_music" src="images/stream.png" onclick="stream(' + item.song_id + ', \'add\');"></li>');
                                                }else{
                                                    $(elem + ' ul').append('<li class=" song_entry_' + item.song_id + '"><img src="get_art.php?song_id=' + item.song_id + '">' + item.name + '<br>' + item.artist_name + '<br> <img class="control_music" src="images/right.png" onclick="play_song(' + item.song_id + ');"><img class="control_music" src="images/plus.png" onclick="add_to_playlist(' + item.song_id + ', \'add\');"><img class="control_music" src="images/stream.png" onclick="stream(' + item.song_id + ', \'add\');"></li>');
                                                }
                                            });
                                          $(elem + ' ul').append('<li class="nav_tabs"></li>');
                                        
                                            if(response.next>0){
                                              $(elem + ' ul .nav_tabs').append('<span  class="nav" onclick="music_browser2(' + response.next + ', ' + response.aid +');" style="float:right;display:inline-block;">Next</span>');
                                            }
                                            if(response.prev & response.offset>0){
                                              $(elem + ' ul .nav_tabs').append('<span class="nav" onclick="music_browser2(' + response.prev + ', ' + response.aid +');" style="float:left;display:inline-block;">Prev</span>');
                                            }
                                }
                        })     
                        })
           }
 
    });
 }
var show_playlist = function(id, clr){

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
  try{
  $('#playlist').accordion().destroy()
  }catch(err){}
  //change above to see if a song is already playing first
  $.ajax({
       url: 'remote_playlist.php',
       type: 'post',
       data: data,
       success: function(response){
            $('#modal').show();
            $('#modal').html('<p class="fa fa-window-close" onclick="$(\'#modal\').hide();"></p>' + response);
            $('#playlist').accordion({ handle: 'h2' });
            $.ajax({
                    url:'torrent_all.php',
                    success: function(response){
                    $('#torrent_search_box').html(response)
                    
                    }
                    
            });    
                music_browser();
            search_music(1);

       }
  });
            load_playlist();
        
}
function stream(song_id){
 
           $('#play_stream source').attr('src', 'http://<?php echo $_SERVER['SERVER_NAME'];?>:3005/music/?id=' + song_id);
           document.getElementById('play_stream').play();
         

}
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.js"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.css" />
</head>

<body>
<i class="fa fa-cog right"></i>
<div id="modal"></div>
<div id="torrent_modal"></div>

<script>
function search_music(p, type){
if(!type){
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
           }else{
           $.ajax({
              url: 'search_music.php?t=' + type + '&q=' + $('input[name="song"]').val() + '&page=' + p,
              success: function(response){
                $('#search_music_box').html(response);
                $('.torrent_link').bind('click touchend', function(ev){
                   ev.preventDefault();
                   get_torrent('torrent.php?folder=' + $(this).attr('alt') + '&url=' +$(this).attr('href'));
                 }); 
                 $('input[name="song"]').bind('keyup touchend', function(ui){
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_music.php?t=' + type + '&folder=' + $('#folder option:selected').val() + '&q=' + $(this).val(),
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
$('#search_music_box input').bind('keyup', function(ui){
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
  function nav_playlist(n, plist, name){
    $.ajax({
           url: '/load_playlists.php',
           data: { start: n, playlist_name: name },
           success: function(response){
             $('#playlist_' + plist).html(response);
             
             init(plist);
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
<div class="sections nav_buttons" style="text-align:center;margin-bottom:10px;">
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
<h1 class="center" id="headline" style="display:none;">
  <a href="http://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html">
    Web Speech API</a> Demonstration</h1>
<div id="info" style="display:none;">
  <p id="info_start">Click on the microphone icon and begin speaking.</p>
  <p id="info_speak_now">Speak now.</p>
  <p id="info_no_speech">No speech was detected. You may need to adjust your
    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
      microphone settings</a>.</p>
  <p id="info_no_microphone" style="display:none">
    No microphone was found. Ensure that a microphone is installed and that
    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
    microphone settings</a> are configured correctly.</p>
  <p id="info_allow">Click the "Allow" button above to enable your microphone.</p>
  <p id="info_denied">Permission to use microphone was denied.</p>
  <p id="info_blocked">Permission to use microphone is blocked. To change,
    go to chrome://settings/contentExceptions#media-stream</p>
  <p id="info_upgrade">Web Speech API is not supported by this browser.
     Upgrade to <a href="//www.google.com/chrome">Chrome</a>
     version 25 or later.</p>
</div>
<div class="right">
  
    <i class="fa fa-microphone"></i>
</div>
<div id="results">
  <span id="final_span" class="final"></span>
  <span id="interim_span" class="interim"></span>
  <p>
</div>
<div class="center" style="display:none;">
  <div class="sidebyside" style="text-align:right">
    <button id="copy_button" class="button" onclick="copyButton()">
      Copy and Paste</button>
    <div id="copy_info" class="info">
      Press Control-C to copy text.<br>(Command-C on Mac.)
    </div>
  </div>
  <div class="sidebyside" style="display:none;">
    <button id="email_button" class="button" onclick="emailButton()">
      Create Email</button>
    <div id="email_info" class="info">
      Text sent to default email application.<br>
      (See chrome://settings/handlers to change.)
    </div>
  </div>
  <p>
  <div id="div_language">
    <select id="select_language" onchange="updateCountry()"></select>
    &nbsp;&nbsp;
    <select id="select_dialect"></select>
  </div>
</div>
<script>

</script>
</body>
<script>
function init(id){

console.log(id)
 $('#music_stream').remove();
$('#playlist_' + id).prepend('<span id="music_stream"><audio id="play_stream" autobuffer controls autoplay><source src="" /></audio> <img id="player_image" style="float:right;width:25%;height:auto;max-width:150px;" src="" /><span id="player_artist_name"></span><br /><span id="player_song_name"></span><br /><span id="player_genre"></span></span>');

setTimeout(function(){
try{
$('#play_stream source').attr('src', '');
document.getElementById('play_stream').pause();
document.getElementById('play_stream').currentTime = 0.0;


		var current = 0;
		
		var songs = {};
		
		$('#playlist_' + id + ' .song_link').each(function(i, item){
		  songs[i] = $(this).attr('href');
		  return songs;
		});
		//$('#playlist_' + id).sortable();
        var idx = 0;
    
        
                run(songs[0]);
                $('a[href="' + songs[0] + '"]').parent().addClass('playing');
                
                
		document.getElementById('play_stream').addEventListener('ended',function(e){
		   idx++;
		  //idx = $('#playlist_' + id + ' .song_link.playing').next('li');
		  
		    if(idx >= $('#playlist_' + id + ' .song_link').length){
		      if($('#playlist_' + id + ' .next.right').length>0){
                $('#playlist_' + id + ' .next.right').click();
		      }else{
                idx = 0;
		      }
             }
            $('li').removeClass('playing');
            
            $('#player_song_name').html($('#playlist_' + id + ' li:nth-child(' + parseInt(idx) + 1 + ') .song_name').html())
            $('#player_artist_name').html($('#playlist_' + id + ' li:nth-child(' + parseInt(idx) + 1 + ') .artist_name').html())
            $('#player_genre').html($('#playlist_' + id + ' li:nth-child(' + parseInt(idx) + 1 + ') .genre').html())
            $('#player_image').attr('src', $('#playlist_' + id + ' li:nth-child(' + parseInt(idx) + 1 + ') img').attr('src'));
			run(songs[idx]);
			$('a[href="' + songs[idx] + '"]').parent().addClass('playing');
		});
		}catch(err){}
		}, 500);
	}
	function run(link){
	
	  if($('#chosen_device option:selected').val() != 'local'){
	    $.ajax({ 
	  
	     url: link,
	     dataType: 'json',
            success: function(response){
                    play_song(response.song_id , 'server');
            }
         });
        return;
	  }
	
//$('#song_' +  id).append('<audio id="play_stream" autobuffer controls autoplay><source src="" /></audio>');
	  $.ajax({ 
	  
	     url: link,
	     dataType: 'json',
	     success: function(response){
                if(!response.msg){
                    link2 = 'http://<?php echo $_SERVER['SERVER_NAME'];?>:3005/music/?id=' + response.song_id;
                    
                        $('#play_stream source').attr('src', link2);
                   
                        document.getElementById('play_stream').load();
                        document.getElementById('play_stream').play();
                }else{
                
                    alert(response.msg);
                }
        }
	});
 }
function init_playlist(type, id){

  init(id);
	
 }
</script> 
<script>
var load_playlist_voice = function(name){

show_playlist();
alert(name)
if(!name){
load_playlist();
return;
}
if(name.length<5){
load_playlist();
return;
}
 
   if(name  == undefined){
      $.ajax({
                url: 'load_playlists.php',
                
                success: function(response){
                    $('#master_list').html(response);
                }
           });     
   
   }else{
   alert(1)
   load_playlist_locally(name)
         
   
   }
}
var load_playlist_locally = function(name, id){
if(name == undefined){
show_playlist();
load_playlist();
return;
}
if(!id & name != undefined){
id=$('ul[alt="' + name + '"]').attr('id');

}

    $.ajax({
        url: 'load_playlists.php',
        data: { playlist_name: name },
        success: function(response){
            $('#playlist_' + id + ' ul').html(response);
            init_playlist(name, id);
        }
    });
}
//
/*
var langs =
[['Afrikaans',       ['af-ZA']],
 ['Bahasa Indonesia',['id-ID']],
 ['Bahasa Melayu',   ['ms-MY']],
 ['Català',          ['ca-ES']],
 ['Čeština',         ['cs-CZ']],
 ['Deutsch',         ['de-DE']],
 ['English',         ['en-AU', 'Australia'],
                     ['en-CA', 'Canada'],
                     ['en-IN', 'India'],
                     ['en-NZ', 'New Zealand'],
                     ['en-ZA', 'South Africa'],
                     ['en-GB', 'United Kingdom'],
                     ['en-US', 'United States']],
 ['Español',         ['es-AR', 'Argentina'],
                     ['es-BO', 'Bolivia'],
                     ['es-CL', 'Chile'],
                     ['es-CO', 'Colombia'],
                     ['es-CR', 'Costa Rica'],
                     ['es-EC', 'Ecuador'],
                     ['es-SV', 'El Salvador'],
                     ['es-ES', 'España'],
                     ['es-US', 'Estados Unidos'],
                     ['es-GT', 'Guatemala'],
                     ['es-HN', 'Honduras'],
                     ['es-MX', 'México'],
                     ['es-NI', 'Nicaragua'],
                     ['es-PA', 'Panamá'],
                     ['es-PY', 'Paraguay'],
                     ['es-PE', 'Perú'],
                     ['es-PR', 'Puerto Rico'],
                     ['es-DO', 'República Dominicana'],
                     ['es-UY', 'Uruguay'],
                     ['es-VE', 'Venezuela']],
 ['Euskara',         ['eu-ES']],
 ['Français',        ['fr-FR']],
 ['Galego',          ['gl-ES']],
 ['Hrvatski',        ['hr_HR']],
 ['IsiZulu',         ['zu-ZA']],
 ['Íslenska',        ['is-IS']],
 ['Italiano',        ['it-IT', 'Italia'],
                     ['it-CH', 'Svizzera']],
 ['Magyar',          ['hu-HU']],
 ['Nederlands',      ['nl-NL']],
 ['Norsk bokmål',    ['nb-NO']],
 ['Polski',          ['pl-PL']],
 ['Português',       ['pt-BR', 'Brasil'],
                     ['pt-PT', 'Portugal']],
 ['Română',          ['ro-RO']],
 ['Slovenčina',      ['sk-SK']],
 ['Suomi',           ['fi-FI']],
 ['Svenska',         ['sv-SE']],
 ['Türkçe',          ['tr-TR']],
 ['български',       ['bg-BG']],
 ['Pусский',         ['ru-RU']],
 ['Српски',          ['sr-RS']],
 ['한국어',            ['ko-KR']],
 ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                     ['cmn-Hans-HK', '普通话 (香港)'],
                     ['cmn-Hant-TW', '中文 (台灣)'],
                     ['yue-Hant-HK', '粵語 (香港)']],
 ['日本語',           ['ja-JP']],
 ['Lingua latīna',   ['la']]];
for (var i = 0; i < langs.length; i++) {
  select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 6;
updateCountry();
select_dialect.selectedIndex = 6;
showInfo('info_start');
function updateCountry() {
  for (var i = select_dialect.options.length - 1; i >= 0; i--) {
    select_dialect.remove(i);
  }
  var list = langs[select_language.selectedIndex];
  for (var i = 1; i < list.length; i++) {
    select_dialect.options.add(new Option(list[i][1], list[i][0]));
  }
  select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
}
var create_email = false;
var final_transcript = '';
var recognizing = true;
var ignore_onend;
var start_timestamp;
if (!('webkitSpeechRecognition' in window)) {
  upgrade();
} else {
  start_button.style.display = 'inline-block';
  var recognition = new webkitSpeechRecognition();
  recognition.continuous = false;
  recognition.interimResults = true;
  recognition.onstart = function() {
    recognizing = true;
    showInfo('info_speak_now');
    start_img.src = 'mic-animate.gif';
  };
  recognition.onerror = function(event) {
    if (event.error == 'no-speech') {
      start_img.src = 'mic.gif';
      showInfo('info_no_speech');
      ignore_onend = true;
    }
    if (event.error == 'audio-capture') {
      start_img.src = 'mic.gif';
      showInfo('info_no_microphone');
      ignore_onend = true;
    }
    if (event.error == 'not-allowed') {
      if (event.timeStamp - start_timestamp < 100) {
        showInfo('info_blocked');
      } else {
        showInfo('info_denied');
      }
      ignore_onend = true;
    }
  };
  recognition.onend = function() {
    recognizing = false;
    if (ignore_onend) {
      return;
    }
    start_img.src = 'mic.gif';
    if (!final_transcript) {
      showInfo('info_start');
      return;
    }
    showInfo('');
    if (window.getSelection) {
      window.getSelection().removeAllRanges();
      var range = document.createRange();
      range.selectNode(document.getElementById('final_span'));
      window.getSelection().addRange(range);
    }
    if (create_email) {
      create_email = false;
      createEmail();
    }
  };
  recognition.onresult = function(event) {
    var interim_transcript = '';
    for (var i = event.resultIndex; i < event.results.length; ++i) {
      if (event.results[i].isFinal) {
        final_transcript = event.results[i][0].transcript;
        if(final_transcript.match(/hey sexy/ig)){
                console.log(final_transcript);
                if(final_transcript.match(/hey sexy playlist/ig)){
                    if(final_transcript.split(/hey sexy playlist/ig).length>1){
                       
                       load_playlist_voice(final_transcript.replace(/hey sexy playlist /ig, ''));
                       alert(final_transcript.replace(/hey sexy playlist /ig, ''))
                        //load_playlist_locally(final_transcript.replace(/playlist /ig, ''));
                    }else{
                        load_playlist_voice();
                    }  
                }
        }
      } else {
        //interim_transcript = event.results[i][0].transcript;
      }
    }
    final_transcript = capitalize(final_transcript);
    final_span.innerHTML = linebreak(final_transcript);
    interim_span.innerHTML = linebreak(interim_transcript);
   
    
  };
}
function upgrade() {
  start_button.style.visibility = 'hidden';
  showInfo('info_upgrade');
}
var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}
var first_char = /\S/;
function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}
function createEmail() {
  var n = final_transcript.indexOf('\n');
  if (n < 0 || n >= 80) {
    n = 40 + final_transcript.substring(40).indexOf(' ');
  }
  var subject = encodeURI(final_transcript.substring(0, n));
  var body = encodeURI(final_transcript.substring(n + 1));
  window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
}
function copyButton() {
  if (recognizing) {
    recognizing = false;
    recognition.stop();
  }
  copy_button.style.display = 'none';
  copy_info.style.display = 'inline-block';
  showInfo('');
}
function emailButton() {
  if (recognizing) {
    create_email = true;
    recognizing = false;
    recognition.stop();
  } else {
    createEmail();
  }
  email_button.style.display = 'none';
  email_info.style.display = 'inline-block';
  showInfo('');
}
function startButton(event) {
  if (recognizing) {
    recognition.stop();
    return;
  }
  final_transcript = '';
  recognition.lang = select_dialect.value;
  recognition.start();
  ignore_onend = false;
  final_span.innerHTML = '';
  interim_span.innerHTML = '';
  start_img.src = 'mic-slash.gif';
  showInfo('info_allow');
  showButtons('none');
  start_timestamp = event.timeStamp;
}
function showInfo(s) {
  if (s) {
    for (var child = info.firstChild; child; child = child.nextSibling) {
      if (child.style) {
        child.style.display = child.id == s ? 'inline' : 'none';
      }
    }
    info.style.visibility = 'visible';
  } else {
    info.style.visibility = 'hidden';
  }
}
var current_style;
function showButtons(style) {
  if (style == current_style) {
    return;
  }
  current_style = style;
  copy_button.style.display = style;
  email_button.style.display = style;
  copy_info.style.display = 'none';
  email_info.style.display = 'none';
}
$(document).ready(function(){
startButton(event);
});*/

// Let's define our first command. First the text we expect, and then the function it should call
function capitalize_Words(str){
try{
 return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
 }catch(err){}
}


socket.on('load artist', function(data){
    show_playlist();
    setTimeout(function(){
     try{
            
            $('#playlist').accordion( "destroy");
            
             $('#playlist').accordion( { handle: 'h2', active: 2});
           
  }catch(err){}
    $('.albums_list').hide(); $('.artists_list').show();
    $('input[name="artist"]').val(data.data[0].artist_name);
        console.log(data);
         search_music(1);
        }, 500);
        setTimeout(function(){
    annyang.abort();
    
        $('.fa-microphone').css('color', 'green');
     }, 1000);   
});
socket.on('load song', function(data){
    setTimeout(function(){
     try{
            
            $('#playlist').accordion( "destroy");
            
             $('#playlist').accordion( { handle: 'h2', active: 2});
           
  }catch(err){}
    $('.albums_list').hide(); $('.artists_list').show();
    alert(data.cmd)
    $('input[name="song"]').val(data.cmd);
   
        console.log(data);
         search_music(1, 'song');
          if($('#song_' + data.data[0].song_id).length>0){
    //  play_song(data.data[0].song_id);
    }
      if($('#song_from_search' + data.data[0].song_id).length>0){
    //  play_song_from_search(data.data[0].song_id);
    }
        }, 500);
        setTimeout(function(){
    annyang.abort();
    
        $('.fa-microphone').css('color', 'green');
     }, 1000);   
});
socket.on('stop_microphone', function(data){
annyang.abort();
    
        $('.fa-microphone').css('color', 'green');
});        
socket.on('load playlist', function(data){
show_playlist();
load_playlist_locally();
setTimeout(function(){  

load_playlist_locally(data.data.playlist_name, data.data.playlist_id);
  id=$('#master_list li:first-child img[src="images/right.png"]').click();
  }, 500);
  setTimeout(function(){
    annyang.abort();
    
        $('.fa-microphone').css('color', 'green');
     }, 1000);   
});
$(document).ready(function(){
    $('.fa-microphone').parent().on('click', function(event){
      var commands = {
    'all playlist:s' : function(){ load_playlist_locally() }
};  
       
        $('.fa-microphone').css('color', 'red');
 
// Add our commands to annyang
annyang.addCommands(commands);
annyang.start();
// Start listening. You can call this here, or attach this call to an event, button, etc.

annyang.addCallback('result', function(txt){
if(!txt){
return;
}
console.log(txt)
var patt = new RegExp(/sexy/ig);
if(txt[0].match(patt)){
try{
document.getElementById('play_stream').pause();
}catch(err){}
return;
}
var patt = new RegExp(/resume/ig);

if(txt[0].match(patt)){
try{
document.getElementById('play_stream').play();
}catch(err){}
return;
}
    socket.emit('load', { cmd: txt })
    
});
   });
});
</script>
</html>
