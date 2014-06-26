<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');

// send all mobile visitors to andymoore.mobi
$mobile = mobile_device_detect(true,true,true,true,true,true,'http://andymoore.mobi/',false);

echo 'This is content that only a fully featured browser would ever see!';

?>