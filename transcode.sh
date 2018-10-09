#!/bin/bash
/usr/bin/ffmpeg -i $1 -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 $2 > $3  2>&1 
