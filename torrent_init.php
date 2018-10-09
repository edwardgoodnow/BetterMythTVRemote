<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('config.php');

?>
<p class="show_downloads fa fa-toggle-down" onclick="$(#torrent_results').toggle();">Show Current Downloads</fa>
<li>
<div id="torrent_stats" style="display:block;">

</div>
</li>
<?php
$conf = array();
$conf['directory'] = '/mnt/storage/';

if(empty($_REQUEST['folder'])){
  $_REQUEST['folder'] = $conf['directory'] . 'music';
  $s_str = '/0/99/101';
 
}

switch($_REQUEST['folder']){
  case('music'):
    $s_str = '/0/99/101';
  break;
  case('games'):
    $s_str = '/0/99/400';
    $mv_folder = explode(" - ", $_REQUEST['q']);
    if(!empty($mv_folder)){
      $new_folder = $mv_folder[1];
    }
  break;
  case('videos'):
    if($_REQUEST['q'] == 'new'){
        $URL = 'https://thepiratebay.org/top/201';
    }else{
      $s_str = '/0/99/200';
    
    }
  break;
  
}
if(empty($URL)){
    $URL = @'https://thepiratebay.org/search/' . @$_REQUEST['q'] . @$s_str;
}
$ch = curl_init();
if(!empty($_REQUEST['url'])){
 $URL = $_REQUEST['url'];
}else{

curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_ENCODING , "gzip");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
curl_setopt($ch, CURLOPT_COOKIE, "language=us_EN; c[thepiratebay.se][/][language]=us_EN");

$pirate = curl_exec ($ch);



$pirate = explode('<table id="searchResult">' , $pirate);

$pirate = @explode('</table>', $pirate[1]);


if(empty($new_folder)){
    $pirate = str_replace("<a href=\"magnet", '<a alt="' . $conf['directory'] . $_REQUEST['folder'] . '" class="torrent_link" href="javascript:;" data-link="magnet', $pirate[0]);
}else{
    $pirate = str_replace("<a href=\"magnet", '<a alt="' . $conf['directory'] . $_REQUEST['folder'] . $mv_folder . '" class="torrent_link" href="javascript:;" data-link="magnet', $pirate[0]);
}
$pirate = str_replace("Type", "", $pirate);
$pirate = str_replace('<center>', '<br class="clear" />', $pirate);
$pirate = str_replace('(', '', $pirate);
$pirate = str_replace(')', '', $pirate);
$pirate = str_replace(', ULed by', '', $pirate);
echo '<div id="torrent_listings">' . $pirate . '</div>';
curl_close($ch);
}
?>
</li>


<script>
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
            torrent = item.split(' ')
     tor_id=torrent[3];
     if(tor_id==''){
     tor_id=torrent[2];
     }
              html += '<li id="torrent_' + tor_id + '" style="display:block;clear:both;color:#fff;width:100%;"><span class="fa fa-trash-o" ></span><span class="fa fa-exchange move torrent_' + tor_id + '"';
              if(torrent[5] != '100%'){
                html += 'style="opacity:0.0;" ';
              }
              
              html += ' alt="' + tor_id + '"></span><span class="fa fa-pause-circle"></span><pre>' + item + '</pre></li>';
              
            });
           // }
           html += '</ul>'; 
           $('#torrent_stats ul li:last-child .s').remove();
           $('#torrent_stats').html(html)
           $('.move').each(function(i, item){
           //  if(!$(this).hasClass('dothis')){
              html = '<i onclick="move_to(' +  $(this).attr('alt') + ', \'music\');" style="cursor:pointer;margin-bottom:20px;">Move to Music</i><br>';
              html += '<i onclick="move_to(' +  $(this).attr('alt') + ', \'videos\');" style="cursor:pointer;margin-bottom:20px;">Move to Videos</i><br>';
              html += '<i onclick="move_to(' +  $(this).attr('alt') + ', \'games\');" style="cursor:pointer;margin-bottom:20px;">Move to Games</i><br>';
              $(this).qtip({ content: { text: html }, hide:false});
             //} 
              
           });
           $('.fa').click(function(e){
          
           e.preventDefault();
                        if($(this).hasClass('fa-trash-o')){
                        action='delete';
                        }else{
                            if(!$(this).hasClass('move')){
                                action = 'pause';
                            }else{
                                action = 'move';
                                 torrent = $(this).parent().find('pre').text().split(' ')[2];
                                 
                                 return;
                            }
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
                     $('#torrent_search_box input, #artist').bind('keyup touchend', function(ui){
                 
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
                    setTimeout(function(){torrent_data() }, 5000)
            
          }
       });   
    
}
function control_torrent2(torrent, action){
  if(action == 'move'){
  
        
  return;
  }
   $.ajax({
          url: 'torrent_stats.php?action=' + action + '&tor=' + encodeURIComponent(torrent),
          success: function(response){
             if(response.length>0){
             alert(response);
             }
          }
     });     

}
torrent_data()
</script>
