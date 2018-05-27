<?php
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
// Free PHP IMDb Scraper Web Service API
// Author: Abhinay Rathore
// Website: http://www.AbhinayRathore.com
// Blog: http://web3o.blogspot.com
// Demo: http://lab.abhinayrathore.com/imdb/
// More Info: http://web3o.blogspot.com/2010/10/php-imdb-scraper-for-new-imdb-template.html
// Last Updated: July 3, 2011
/////////////////////////////////////////////////////////////////////////////////////////////////////////

exec('curl -X GET --header "Accept: application/json" --header "user-key: 972f35974d573b7e68d77ec7a6d80253" "https://api-2445582011268.apicast.io/games/?search=' . $_REQUEST['m'] . '&fields=*"', $out, $err);

if(!empty($_REQUEST['f'])){
echo json_encode($out);
}else{
?>

<?php
 $html = '<ul>';
    $dont_show= array('poster_large', 'poster_full');
    function evaluate_array($array){
    $dont_show= array('poster_large', 'poster_full');
      $html = '';
      foreach($array as $k => $value){
      
            if(!is_array($value) & !in_Array(strtolower($k), $dont_show)){
                if(strtolower($k)=='title_id'){
                    $html .= '<li class="button" onclick="update_video(\'' . $value . '\');">Update Video</li>';
                }  
                if(strtolower($k)=='poster'){
                    $html .= '<img src="' . $value . '" align="left" style="float:left;" />';
                }else{
                    $html.='<li><label>' . ucwords(implode(' ', explode('_', strtolower($k)))) . ':</label>' . $value . '</li>';
                }    
            }else{
              $html .= evaluate_array($value);
            }
         } 
     return $html;
    } 
    
    $dont_show= array('poster_large', 'poster_full');
    
    foreach($out as $k => $json){
        $value = json_decode($json, true);
      
            if(!is_array($value) & !in_Array(strtolower($k), $dont_show)){
                if(strtolower($k)=='title_id'){
                    $html .= '<li class="button" onclick="update_video(\'' . $value . '\');">Update Video</li>';
                }  
                if(strtolower($k)=='poster'){
                    $html .= '<img src="' . $value . '" align="left" style="float:left;" />';
                }else{
                    $html.='<li><label>' . ucwords(implode(' ', explode('_', strtolower($k)))) . ':</label>' . $value . '</li>';
                }    
            }else{
              $html .= evaluate_array($value);
            }
         }   
      
    $html .= '</ul>';
    echo $html;


}
