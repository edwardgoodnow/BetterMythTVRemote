<?php


exec('su - edward & transmission-remote -w "' . $_REQUEST['folder_get'] . '/" --add "' . urldecode($_REQUEST['url']) .'"  --auth=transmission:transmission
');
