<?php
require('config.php');
$varray = array('avi', 'mp4', 'mkv', 'flv', 'wmv');
$iarray = array('png', 'jpg', 'gif', 'bmp', 'jpeg');

       $ext = @pathinfo(urldecode($_REQUEST['path']), PATHINFO_EXTENSION);
       if(in_array($ext, $iarray)){
         $type='image';
       }else if(in_array($ext, $varray)){
         $type= 'video';
       }
       //echo $ext;
        @header('content-type: ' . $type . '/' . $ext);
        $str= file_get_contents(urldecode($_REQUEST['path']));

echo $str;
