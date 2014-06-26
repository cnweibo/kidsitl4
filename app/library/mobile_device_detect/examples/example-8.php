<?php

require_once('mobile_device_detect.php');
$mobile = mobile_device_detect();

if(is_array($mobile)){
	echo 'This is the reason why the script detected this user agent as a mobile: <b>'.$mobile['1'].'</b>';
}else{
	echo 'It all seems pretty normal here.';
}


?>