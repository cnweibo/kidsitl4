<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');
$mobile = mobile_device_detect();

// simple true or false test
if($mobile==true){
  echo 'You appear to be using a mobile device';
}else{
  echo 'You appear to be using a fully featured desktop browser';
}

?>