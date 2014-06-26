<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');

// send all desktop visitors to andymoore.info
$mobile = mobile_device_detect(true,true,true,true,true,true,false,'http://andymoore.info/');

echo 'This is content that only a mobile device would ever see!';

?>