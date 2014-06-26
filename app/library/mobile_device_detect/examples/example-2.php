<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');
$mobile = mobile_device_detect();

// redirect all mobiles to mobile site and all other browsers to desktop site
if($mobile==true){
  header('Location:http://andymoore.mobi/');
}else{
  header('Location:http://andymoore.info/');
}
exit;

?>