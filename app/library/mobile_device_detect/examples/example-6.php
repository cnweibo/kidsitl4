<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');

$mobile = mobile_device_detect();

// show a desktop template for full browsers and a mobile template for mobiles
if($mobile==true){

  echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Mobile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    This a basic XHTML mobile template
  </body>
</html>';


}else{

  echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <html>
  <head>
    <title>Desktop</title>
    <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  </head>
  <body>
    This is a basic XHTML desktop template
  </body>
</html>';

}

?>