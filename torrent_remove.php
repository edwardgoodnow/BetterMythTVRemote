<?php


exec('su - edward & transmission-remote -t ' . $_REQUEST['id'] . ' -r');
