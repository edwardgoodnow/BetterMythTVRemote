<?php
require('config.php');
//echo "transmission-remote -n 'transmission:transmission' -l";
exec("transmission-remote -n 'transmission:transmission' -l", $out, $stats);

$cols = $out[0];

unset($out[0]);
print_r($out);
foreach($out as $ky => $a){
echo $a;
  if(preg_match('/(.*)Seeding(.*)/', $a)){
    $data = preg_split('/\s+/', $a);
    echo 'transmission-remote --auth=root:letmein1 -t ' . $data[1] . ' -r';
    exec('transmission-remote --auth=root:letmein1 -t ' . $data[1] . ' -r', $out, $stats);
  }
}

exec("/usr/bin/mythutil --scanmusic 2&>/dev/null", $out, $stats);
exec("/usr/bin/mythutil --scanvideos 2&>/dev/null", $out, $stats);

exec("/usr/bin/mythutil --notification --message_text \"Download Complete\" --timeout 30  2&>/dev/null", $out, $stats);
exec('php ./convert_all_videos.php');
