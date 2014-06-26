<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');
$mobile = mobile_device_detect();

// include one file for mobiles and another for fully featured browsers
if($mobile==true){
  require_once('mobile.html');
}else{
  require_once('desktop.html');
}
exit;

?>