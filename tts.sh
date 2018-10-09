#!/bin/bash
espeak  -ven-us+f3 -s170 "{$1}" --stdout | aplay -D 'plughw:CARD=Device_1,DEV=0'

