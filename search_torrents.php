<?php
require('config.php');


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
}
echo $URL;
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_ENCODING , "gzip");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
curl_setopt($ch, CURLOPT_COOKIE, "language=us_EN; c[thepiratebay.se][/][language]=us_EN");

$pirate = curl_exec ($ch);



$pirate = explode('<table id="searchResult">' , $pirate);

$pirate = @explode('</table>', $pirate[1]);
//print_r($pirate);

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

?>
