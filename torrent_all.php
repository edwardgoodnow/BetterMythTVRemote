<?php
require('config.php');
?>
<style>
#torrent_listings {
    text-align: left;
}
.detLink {
	font-size: 12px;
	margin-left: 43px;
}
a[title="More from this category"] {
	display: none;
}
</style>
<div id="torrent_stats" style="display:block;">

</div>
<span class="border white">

<label>Search For Download</label>
<input id="artist" name="artist" value="" />
<label>Media Type</label>
<select id="tor_folder" name="tor_folder">
   <option value="music">Music</option>
   <option value="videos">Videos</option>
   <option value="games">Games</option>
</select>

</span>

<span id="search_torrent_inner">

</span>
<script>
                 $('#torrent_search_box input').bind('keyup touchend', function(ui){
                 
                    if(ui.which==13){
                    $.ajax({
                            url: 'search_torrents.php?folder=' + $('#tor_folder option:selected').val() + '&torrent=1&q=' + $(this).val(),
                            success: function(response){
                                $('#search_torrent_inner').html( response );
                                $('.torrent_link').bind('click touchend', function(ev){
                           
                                ev.preventDefault();
                                get_torrent('torrent.php?folder_get=' + $(this).attr('alt') + '&url=' + encodeURIComponent($(this).attr('data-link')));
                                });  
                            }
                        });
                        }
                    });
function torrent_data(){
  $.ajax({
          url: 'torrent_stats.php',
          success: function(response){
           html = '<ul>';
           data = JSON.parse(response);
           html += '<li style="display:block;clear:both;color:red;width:100%;text-indent:20px;font-weight:bold;"><pre>ID   Done     Have      ETA        Up     Down  Ratio     Status     Name</pre></li>';
           e=0;
           //if(data.data.length>0){
            $.each(data.data, function(i, item){
             // console.log(item);
            
              html += '<li style="display:block;clear:both;color:#fff;width:100%;"><span class="fa fa-trash-o" ></span><span class="fa fa-pause-circle"></span><pre>' + item + '</pre></li>';
              
            });
           // }
           html += '</ul>'; 
           $('#torrent_stats ul li:last-child .s').remove();
           $('#torrent_stats').html(html)
           
           $('.fa').click(function(e){
          
           e.preventDefault();
                        if($(this).hasClass('fa-trash-o')){
                        action='delete';
                        }else{
                        action = pause;
                        }
                        torrent = $(this).parent().find('pre').text().split(' ')[3];
                    
                       if(torrent == ''){
                       torrent = $(this).parent().find('pre').text().split(' ')[2];
                       
                       }
                       if(torrent == ''){
                       torrent = $(this).parent().find('pre').text().split(' ')[1];
                       
                       }
                       if(torrent == ''){
                       torrent = $(this).parent().find('pre').text().split(' ')[0];
                       
                       }
                        control_torrent2(torrent, action);
                    });
            
          }
       });   
    
}
function control_torrent2(torrent, action){
   $.ajax({
          url: 'torrent_stats.php?action=' + action + '&tor=' + encodeURIComponent(torrent),
          success: function(response){
             alert(response);
          }
     });     

}
setInterval(function(){
    torrent_data()
} , 10000);
</script>                    
