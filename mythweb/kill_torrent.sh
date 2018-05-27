#!/bin/bash
killall -9 transmission-cli
exec('su - egoodnow');
mythutil --scanmusic
mythutil --scanvideos
mythutil --notification --message_text "Download Complete" --timeout 10
