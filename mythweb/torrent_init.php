<li class="torrent_results">
<p>No Local Results Found...searching torrent sites</p>
<?php 
$URL = 'https://thepiratebay.org/search/' . $_REQUEST['q'] . '/0/99/101';

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

$pirate = explode('</table>', $pirate[1]);
//print_r($pirate);


$pirate = str_replace('<a href="magnet', '<a class="torrent_link" href="magnet', $pirate[0] );
$pirate = str_replace('<center>', '<br class="clear" />', $pirate);
$pirate = str_replace('(', '', $pirate);
$pirate = str_replace(')', '', $pirate);
$pirate = str_replace(', ULed by', '', $pirate);
echo $pirate;
curl_close($ch);
}
?>
</li>
