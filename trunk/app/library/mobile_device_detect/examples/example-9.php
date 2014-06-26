<?php

require_once('mobile_device_detect.php');
$mobile = mobile_device_detect();

if($mobile&&(preg_match('/applewebkit/i',$_SERVER['HTTP_USER_AGENT'])){
 echo 'is a webkit mobile that should support html 5';
}else if($mobile){
echo 'is a mobile';
 }else{
echo 'is not a mobile';
 } 

?>