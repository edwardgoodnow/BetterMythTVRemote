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
                        torrent = $(this).parent().find('pre').text().split(' ')[0];
                      
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
