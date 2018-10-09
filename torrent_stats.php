<?php
require('config.php');
$out = array(0 => '');
if(!empty($_REQUEST['tor'])){
  $data = preg_split('/\s+/', $_REQUEST['tor']);
  if($_REQUEST['action']=='delete'){
  //echo 'transmission-remote --auth=root:letmein1 -t ' . $_REQUEST['tor'] . ' -r';
    exec('transmission-remote --auth=transmission:transmission -t ' . $_REQUEST['tor'] . ' -r', $out, $stats);
  }else{
  
  }
   echo $out[0];
   exit;
}
exec("transmission-remote -n 'transmission:transmission' -l", $out, $stats);

$cols = $out[0];

unset($out[0]);

//$out = explode(',', $out);
echo json_encode(array('cols' => $cols, 'data' => $out));
