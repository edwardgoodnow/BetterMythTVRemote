<?php
echo 'transmission-cli -w /mnt/storage/' . $_REQUEST['folder'] . '/ ' . $_REQUEST['url'];
exec('transmission-cli -w /mnt/storage/' . $_REQUEST['folder'] . '/ ' . $_REQUEST['url']);
