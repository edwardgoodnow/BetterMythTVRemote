<?php

ini_set('display_errrors', 1);
@session_start();
$conn = mysqli_connect('localhost', 'mythtv', 'mythtv', 'mythconverg');
$conf = array();
$conf['directory'] = '/mnt/storage/';
